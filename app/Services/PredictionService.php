<?php

namespace App\Services;

/**
 * PredictionService using Poisson Distribution
 * 
 * Inspired from: https://dashee87.github.io/football/python/predicting-football-results-with-statistical-modelling/
 * 
 * Attack, Defense, Midfield stats from: https://www.fifaindex.com/teams/fifa21/
 */
class PredictionService
{
    /**
     * Calculate the factorial of a number
     * 
     * @param int $number
     * 
     * @return int
     */
    public function factorial($n)
    {
        if ($n == 0) return 1;

        return $n * $this->factorial($n - 1);
    }

    /**
     * Get the winner of game
     * 
     * @param int $hostGoals
     * @param int $guestGoals
     * 
     * @return string
     */
    public function gameOutcome($hostGoals, $guestGoals)
    {
        if ($hostGoals > $guestGoals) {
            return 'HOST';
        } elseif ($hostGoals < $guestGoals) {
            return 'GUEST';
        } else {
            return 'DRAW';
        }
    }

    /**
     * Calculate the lambdas for each team
     * 
     * Lambdas will be calculates based on attack, defense and midfield stats of each team
     * 
     * @param \App\Models\Team $hostTeam
     * @param \App\Models\Team $guestTeam
     * 
     * @return float
     */
    public function computeLambdas($hostTeam, $guestTeam)
    {
        $m = [
            'intercept' => 0.113983,
            'is_home' => 0.229118,
            'AvD' => 0.024168,
            'MvM' => 0.035651
        ];

        return [
            'host' => exp($m['intercept'] + $m['is_home'] * 1 + $m['AvD'] * ($hostTeam->attackRating - $guestTeam->defenceRating) + $m['MvM'] * ($hostTeam->midfieldRating - $guestTeam->midfieldRating)),
            'guest' => exp($m['intercept'] + $m['is_home'] * 0 + $m['AvD'] * ($guestTeam->attackRating - $hostTeam->defenceRating) + $m['MvM'] * ($guestTeam->midfieldRating - $hostTeam->midfieldRating)),
        ];
    }

    /**
     * Poisson Distribution PDF
     * 
     * @param int $N
     * @param float $lambda
     * 
     * @return mixed
     */
    public function poissonPDF($N, $lambda)
    {
        return (pow($lambda, $N) * exp(-$lambda)) / $this->factorial($N);
    }

    /**
     * Poisson Distribution CDF
     * 
     * @param int $N
     * @param float $lambda
     * 
     * @return mixed
     */
    public function poissonCDF($N, $lambda)
    {
        $probs = [];
        for ($i = 0; $i <= $N; $i++) {
            $probs[] = $this->poissonPDF($i, $lambda);
        }
        return array_reduce($probs, function ($accumulator, $current) {
            return $accumulator + $current;
        });
    }

    /**
     * Utility function for getting random values with weighting.
     * 
     * Based on https://gist.github.com/irazasyed/f41f8688a2b3b8f7b6df
     * 
     * @param array $weightedValues
     * 
     * @return mixed
     */
    function getRandomWeightedElement(array $weightedValues)
    {
        // Make sure we have an array with asc order
        uasort($weightedValues, function ($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });

        $rand = mt_rand(1, (int) array_sum($weightedValues));

        foreach ($weightedValues as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
    }

    /**
     * Predict the goals of a game
     * 
     * @param \App\Models\Team $hostTeam
     * @param \App\Models\Team $guestTeam
     * 
     * @return array
     */
    public function predictScores($hostTeam, $guestTeam)
    {
        $lambda = $this->computeLambdas($hostTeam, $guestTeam);
        $scores = [];

        // HOME, AWAY 0-4 goals
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                array_push($scores, [
                    'host' => $i,
                    'guest' => $j,
                    'result' => $this->gameOutcome($i, $j),
                    'probability' => $this->poissonPDF($i, $lambda['host']) * $this->poissonPDF($j, $lambda['guest'])
                ]);
            }
        }

        // HOME with AWAY = 5+
        for ($i = 0; $i < 5; $i++) {
            array_push($scores, [
                'host' => $i,
                'guest' => '5+',
                'result' => 'GUEST',
                'probability' => $this->poissonPDF($i, $lambda['host']) * (1 - $this->poissonCDF(4, $lambda['guest']))
            ]);
        }

        // AWAY with HOME = 5+
        for ($i = 0; $i < 5; $i++) {
            array_push($scores, [
                'host' => '5+',
                'guest' => $i,
                'result' => 'HOST',
                'probability' => $this->poissonPDF($i, $lambda['guest']) * (1 - $this->poissonCDF(4, $lambda['host']))
            ]);
        }

        // HOME with AWAY = 5+
        array_push($scores, [
            'host' => '5+',
            'guest' => '5+',
            'result' => 'DRAW',
            'probability' => (1 - $this->poissonCDF($i, $lambda['host'])) * (1 - $this->poissonCDF(4, $lambda['guest']))
        ]);

        // Get the probability for host team to win
        $resultHost = array_reduce(array_filter($scores, function ($score) {
            return $score['result'] == 'HOST';
        }), function ($acc, $value) {
            return $acc + $value['probability'];
        }, 0);

        // Get the probability for guest team to win
        $resultGuest = array_reduce(array_filter($scores, function ($score) {
            return $score['result'] == 'GUEST';
        }), function ($acc, $value) {
            return $acc + $value['probability'];
        }, 0);

        // Get the probability for draw
        $resultDraw = array_reduce(array_filter($scores, function ($score) {
            return $score['result'] == 'DRAW';
        }), function ($acc, $value) {
            return $acc + $value['probability'];
        }, 0);

        // Randomly select a winner based on the probabilities weigths
        $winner = $this->getRandomWeightedElement([
            'HOST' => intval($resultHost * 100),
            'GUEST' => intval($resultGuest * 100),
            'DRAW' => intval($resultDraw * 100),
        ]);

        // Get goals for each team by score
        $hostGoals = rand(1, 10);
        $guestGoals = $hostGoals;

        // Update goals for each team by winner if it is not a draw
        // TODO: Make sure that the goals are more than 0
        if ($winner == 'HOST') {
            $guestGoals -= rand(1, $hostGoals);
        } else if ($winner == 'GUEST') {
            $hostGoals -= rand(1, $guestGoals);
        }

        return [
            'hostGoals' => $hostGoals,
            'guestGoals' => $guestGoals,
        ];
    }
}
