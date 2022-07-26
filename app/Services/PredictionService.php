<?php

namespace App\Services;

class PredictionService
{
    public function factorial($n)
    {
        if ($n == 0) return 1;

        return $n * $this->factorial($n - 1);
    }

    public function gameOutcome($homeGoals, $awayGoals)
    {
        if ($homeGoals > $awayGoals) {
            return 'HOME';
        } elseif ($homeGoals < $awayGoals) {
            return 'AWAY';
        } else {
            return 'DRAW';
        }
    }

    public function computeLambdas($homeTeam, $awayTeam)
    {
        $m = [
            'intercept' => 0.113983,
            'is_home' => 0.229118,
            'AvD' => 0.024168,
            'MvM' => 0.035651
        ];

        return [
            'home' => exp($m['intercept'] + $m['is_home'] * 1 + $m['AvD'] * ($homeTeam->attackRating - $awayTeam->defenceRating) + $m['MvM'] * ($homeTeam->midfieldRating - $awayTeam->midfieldRating)),
            'away' => exp($m['intercept'] + $m['is_home'] * 0 + $m['AvD'] * ($awayTeam->attackRating - $homeTeam->defenceRating) + $m['MvM'] * ($awayTeam->midfieldRating - $homeTeam->midfieldRating)),
        ];
    }

    public function poissonPDF($N, $lambda)
    {
        return (pow($lambda, $N) * exp(-$lambda)) / $this->factorial($N);
    }

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

    public function weightedRandom($probabilities)
    {
        $rand = mt_rand() / mt_getrandmax();
        $sum = 0;
        foreach ($probabilities as $key => $probability) {
            $sum += $probability;
            if ($rand <= $sum) {
                return $key;
            }
        }
    }

    /**
     * getRandomWeightedElement()
     * Utility function for getting random values with weighting.
     * Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50)
     * An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
     * The return value is the array key, A, B, or C in this case.  Note that the values assigned
     * do not have to be percentages.  The values are simply relative to each other.  If one value
     * weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
     * chance of being selected.  Also note that weights should be integers.
     * 
     * @author https://github.com/irazasyed
     * 
     * @param array $weightedValues
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

    public function predictScores($homeTeam, $awayTeam)
    {
        $lambda = $this->computeLambdas($homeTeam, $awayTeam);
        $scores = [];

        // HOME, AWAY 0-4 goals
        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                array_push($scores, [
                    'home' => $i,
                    'away' => $j,
                    'result' => $this->gameOutcome($i, $j),
                    'probability' => $this->poissonPDF($i, $lambda['home']) * $this->poissonPDF($j, $lambda['away'])
                ]);
            }
        }

        // HOME with AWAY = 5+
        for ($i = 0; $i < 5; $i++) {
            array_push($scores, [
                'home' => $i,
                'away' => '5+',
                'result' => 'AWAY',
                'probability' => $this->poissonPDF($i, $lambda['home']) * (1 - $this->poissonCDF(4, $lambda['away']))
            ]);
        }

        // AWAY with HOME = 5+
        for ($i = 0; $i < 5; $i++) {
            array_push($scores, [
                'home' => '5+',
                'away' => $i,
                'result' => 'HOME',
                'probability' => $this->poissonPDF($i, $lambda['away']) * (1 - $this->poissonCDF(4, $lambda['home']))
            ]);
        }

        array_push($scores, [
            'home' => '5+',
            'away' => '5+',
            'result' => 'DRAW',
            'probability' => (1 - $this->poissonCDF($i, $lambda['home'])) * (1 - $this->poissonCDF(4, $lambda['away']))
        ]);

        $resultHome = array_reduce(array_filter($scores, function ($score) {
            return $score['result'] == 'HOME';
        }), function ($acc, $value) {
            return $acc + $value['probability'];
        }, 0);

        $resultAway = array_reduce(array_filter($scores, function ($score) {
            return $score['result'] == 'AWAY';
        }), function ($acc, $value) {
            return $acc + $value['probability'];
        }, 0);

        $resultDraw = array_reduce(array_filter($scores, function ($score) {
            return $score['result'] == 'DRAW';
        }), function ($acc, $value) {
            return $acc + $value['probability'];
        }, 0);

        // Randomly select a winner based on the probabilities
        $winner = $this->getRandomWeightedElement([
            'HOME' => intval($resultHome * 100),
            'AWAY' => intval($resultAway * 100),
            'DRAW' => intval($resultDraw * 100),
        ]);

        // Get goals for each team by score
        $hostGoals = rand(1, 10);
        $guestGoals = $hostGoals;

        // Update goals for each team by winner
        if ($winner == 'HOME') {
            $guestGoals -= rand(1, $hostGoals);
        } else if ($winner == 'AWAY') {
            $hostGoals -= rand(1, $guestGoals);
        }

        return [
            'hostGoals' => $hostGoals,
            'guestGoals' => $guestGoals,
        ];
    }
}
