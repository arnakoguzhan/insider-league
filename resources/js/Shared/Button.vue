<template>
    <component class="font-medium flex items-center cursor-pointer border focus:outline-none" :is="buttonType"
        :href="href" :type="type" :class="btnClasses" v-on="$listeners">
        <svg v-show="isLoading" class="w-5 h-5 text-white animate-spin mr-2" fill="none" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
            </circle>
            <path class="opacity-75"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                fill="currentColor"></path>
        </svg>
        <slot></slot>
    </component>
</template>

<script>
export default {
    props: {
        href: {
            required: false,
            type: String,
            default: null
        },
        type: {
            type: String,
            default: "button" //button, submit
        },
        id: {
            type: String,
            required: false
        },
        name: {
            type: String,
            required: false
        },
        color: {
            type: String,
            default: "teal"
        },
        textColor: {
            type: String,
            default: "white"
        },
        size: {
            type: String,
            default: "md" //sm, md, lg
        },
        outline: Boolean,
        isLoading: Boolean,
        icon: Boolean,
        round: Boolean
    },
    computed: {
        colorClasses() {
            const color = this.color;
            const textColor = this.textColor;
            const baseClasses = `bg-${color}-600 text-${textColor} border-${color}-600 hover:bg-${color}-700 hover:border-${color}-700`;
            const outlineClasses = `border-${color}-600 bg-white text-${color}-600 hover:bg-${color}-600 hover:border-${color}-600 hover:text-white`;
            return this.outline ? outlineClasses : baseClasses;
        },
        sizeClasses() {
            const isIcon = this.icon;
            const sizeMappings = {
                sm: `h-8 text-sm ${isIcon ? "px-2" : "px-4"}`,
                md: `h-10 ${isIcon ? "px-3" : "px-6"}`,
                lg: `text-lg h-12 ${isIcon ? "px-4" : "px-12"}`
            };

            return sizeMappings[this.size] || sizeMappings.md;
        },
        btnClasses() {
            const borderRadiusClasses = this.round ? "rounded-full" : "rounded";
            return `${this.colorClasses} ${this.sizeClasses} ${borderRadiusClasses}`;
        },
        buttonType() {
            if (this.href) {
                return "Link";
            } else {
                return "button";
            }
        }
    },
};
</script>