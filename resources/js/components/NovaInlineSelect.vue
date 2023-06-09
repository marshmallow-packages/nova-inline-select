<template>
    <div class="mm-nova-inline-selector">
        <div class="mm-relative">
            <button
                ref="toggleButton"
                :style="{ maxWidth: maxWidth }"
                @click.prevent="toggleOptions(toggleButton)"
                type="button"
                class="mm-relative mm-w-full mm-cursor-pointer mm-rounded-md mm-bg-white mm-py-1.5 mm-pl-3 mm-pr-2 mm-text-left mm-text-gray-900 mm-shadow-sm mm-ring-1 mm-ring-inset mm-ring-gray-300 mm-focus:outline-none mm-focus:ring-2 mm-focus:ring-indigo-500 mm-sm:text-sm mm-sm:leading-6 hover:mm-bg-gray-50"
                aria-haspopup="listbox"
                aria-expanded="true"
                aria-labelledby="listbox-label"
            >
                <span v-if="selectedOption" class="mm-flex mm-items-center">
                    <span
                        v-if="!loading && this.field.useImages"
                        v-html="this.getOptionAvatar(selectedOption.value)"
                    />
                    <Loader v-if="loading" />
                    <span v-if="showLabel" class="mm-ml-3 mm-block mm-truncate">
                        {{ selectedOption.label }}
                    </span>
                </span>
                <span v-else class="mm-flex mm-items-center">
                    <span
                        v-if="!loading && this.field.useImages"
                        v-html="this.field.noAvatarImage"
                    />
                    <Loader v-if="loading" />
                    <span
                        v-if="showLabel"
                        class="mm-ml-3 mm-block mm-truncate"
                        >{{ field.noOptionSelected }}</span
                    >
                </span>

                <span
                    v-if="showArrows"
                    class="mm-pointer-events-none mm-absolute mm-inset-y-0 mm-right-0 mm-ml-3 mm-flex mm-items-center mm-pr-2"
                >
                    <svg
                        class="mm-h-5 mm-w-5 mm-text-gray-400"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </span>
            </button>
            <ul
                :class="[selectOptionsOpen ? 'mm-visable' : 'mm-hidden']"
                :style="{
                    left: selectOptionsPosition.left,
                    top: selectOptionsPosition.top,
                }"
                class="mm-fixed mm-z-10 mm-mt-1 mm-max-h-56 mm-w-full mm-overflow-auto mm-rounded-md mm-bg-white mm-py-1 mm-text-base mm-shadow-lg mm-ring-1 mm-ring-black mm-ring-opacity-5 mm-focus:outline-none mm-sm:text-sm mm-max-w-[400px]"
                tabindex="-1"
                role="listbox"
                aria-labelledby="listbox-label"
                aria-activedescendant="listbox-option-3"
            >
                <li
                    @click.prevent="updateValue(value)"
                    v-for="(value, key) in this.field.options"
                    :key="key"
                    :class="[
                        this.isCurrentlySelected(value.value)
                            ? 'mm-bg-gray-100 mm-text-gray-900'
                            : 'mm-text-gray-900 hover:mm-bg-gray-50',
                    ]"
                    class="mm-relative mm-cursor-pointer mm-select-none mm-py-2 mm-pl-3 mm-pr-9"
                    id="listbox-option-0"
                    role="option"
                >
                    <div class="mm-flex mm-items-center">
                        <span
                            v-if="this.field.useImages"
                            v-html="this.getOptionAvatar(value.value)"
                        />
                        <span
                            :class="[
                                this.isCurrentlySelected(value.value)
                                    ? 'mm-font-semibold'
                                    : 'mm-font-normal',
                            ]"
                            class="mm-ml-3 mm-block mm-truncate"
                        >
                            {{ value.label }}
                        </span>
                    </div>
                    <span
                        v-if="this.isCurrentlySelected(value.value)"
                        class="mm-text-green-500 mm-absolute mm-inset-y-0 mm-right-0 mm-flex mm-items-center mm-pr-4"
                    >
                        <svg
                            class="mm-h-5 mm-w-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import Loader from "./Loader.vue";
    import find from "lodash/find";
    // import first from 'lodash/first'
    import isNil from "lodash/isNil";
    import { DependentFormField, HandlesValidationErrors } from "laravel-nova";

    export default {
        components: {
            Loader,
        },

        mixins: [HandlesValidationErrors, DependentFormField],

        props: [
            "index",
            "resource",
            "resourceName",
            "resourceId",
            "field",
            "showLabel",
            "maxWidth",
            "showArrows",
        ],

        data: () => ({
            search: "",
            selectedOption: null,
            value: null,
            selectOptionsOpen: false,
            selectOptionsPosition: {},
            loading: false,
        }),

        created() {
            /** Add this listener to close the drop down when clicking outside. */
            window.addEventListener("click", (e) => {
                if (
                    !this.$parent.$el.querySelector(
                        ".mm-nova-inline-selector"
                    ) ||
                    !this.$parent.$el
                        .querySelector(".mm-nova-inline-selector")
                        .contains(e.target)
                ) {
                    this.selectOptionsOpen = false;
                }
            });

            window.addEventListener("scroll", (e) => {
                this.selectOptionsOpen = false;
            });

            let value = this.field.value ?? "";

            let self = this;
            Nova.$on("should-close-all-nova-inline-select", function () {
                self.selectOptionsOpen = false;
            });

            let selectedOption = find(
                this.field.options,
                (v) => v.value == value
            );

            if (selectedOption) {
                this.$nextTick(() => {
                    this.selectOption(selectedOption);
                });
            }
        },

        methods: {
            toggleOptions(toggleButton) {
                /** Get the position of the clicked butto because we need options list has a fixed position. */
                const left =
                    this.$refs.toggleButton.getBoundingClientRect().left;
                const top = this.$refs.toggleButton.getBoundingClientRect().top;

                /** Get the new status for the option list. */
                let new_status = !this.selectOptionsOpen;

                /** Make sure all open options lists are closed when we open a new one. */
                Nova.$emit("should-close-all-nova-inline-select");

                /** Set the new status */
                this.selectOptionsOpen = new_status;

                /**
                 * Caculate the size of the options list. We dont have to go over 5.3 because
                 * the option list has a max height and will be scrollable if it has more then 5 items.
                 * */
                let optionsCountForOffset =
                    this.field.options.length > 5
                        ? 5.3
                        : this.field.options.length;
                let optionsContainerHeight = 44 * optionsCountForOffset;

                this.selectOptionsPosition.left = left + "px";

                /**
                 * If the position of the options list is bigger then the window height
                 * we need to add the options list above the button.
                 */
                if (top + optionsContainerHeight > window.innerHeight - 30) {
                    this.selectOptionsPosition.top =
                        top - optionsContainerHeight + "px";
                } else {
                    this.selectOptionsPosition.top = top + 30 + "px";
                }
            },

            updateValue(option) {
                this.loading = true;
                /** Set the new option for displaying */
                this.selectedOption = option;

                /** Close the option box */
                this.selectOptionsOpen = false;

                this.emitFieldValueChange(this.field.attribute, option.value);
                this.submit(option.value);
            },

            async submit(value) {
                let self = this;
                let formData = new FormData();

                formData.append("attribute", this.field.attribute);
                formData.append(this.field.attribute, value);
                formData.append("_method", "PUT");

                return Nova.request()
                    .post(
                        `/nova-vendor/nova-inline-select/${this.resourceName}/${this.resourceId}`,
                        formData
                    )
                    .then(
                        () => {
                            let label = find(
                                this.field.options,
                                (option) => option.value === value
                            ).label;

                            Nova.success(
                                `${this.field.name} updated to "${label}"`
                            );
                        },
                        (response) => {
                            Nova.error(response);
                        }
                    )
                    .finally(() => {
                        // this.showUpdateButton = false;
                        self.loading = false;
                    });
            },

            /** Check if the value is the same as the currently selected option. */
            isCurrentlySelected(value) {
                if (this.selectedOption && this.selectedOption.value) {
                    return this.selectedOption.value === value;
                }
                return false;
            },

            getOptionAvatar(value) {
                let avatar = find(this.field.avatarImages, function (v, k) {
                    return k == value;
                });

                if (avatar) {
                    return avatar;
                }

                return this.field.noAvatarImage;
            },

            /**
             * Provide a function that fills a passed FormData object with the
             * field's internal value attribute. Here we are forcing there to be a
             * value sent to the server instead of the default behavior of
             * `this.value || ''` to avoid loose-comparison issues if the keys
             * are truthy or falsey
             */
            // fill(formData) {
            //     this.fillIfVisible(
            //         formData,
            //         this.field.attribute,
            //         this.value ?? ""
            //     );
            // },

            /**
             * Set the search string to be used to filter the select field.
             */
            // performSearch(event) {
            //     this.search = event;
            // },

            /**
             * Clear the current selection for the field.
             */
            // clearSelection() {
            //     this.selectedOption = "";
            //     this.value = "";

            //     if (this.field) {
            //         this.emitFieldValueChange(this.field.attribute, this.value);
            //     }
            // },

            /**
             * Select the given option.
             */
            selectOption(option) {
                if (isNil(option)) {
                    this.clearSelection();
                    return;
                }

                this.selectedOption = option;
                this.value = option.value;

                if (this.field) {
                    this.emitFieldValueChange(this.field.attribute, this.value);
                }
            },

            /**
             * Handle the selection change event.
             */
            handleChange(value) {
                let selectedOption = find(
                    this.currentField.options,
                    (v) => v.value == value
                );

                this.selectOption(selectedOption);
            },

            /**
             * Handle on synced field.
             */
            // onSyncedField() {
            //     let currentSelectedOption = null;
            //     let hasValue = false;

            //     if (this.selectedOption) {
            //         hasValue = true;
            //         currentSelectedOption = find(
            //             this.currentField.options,
            //             (v) => v.value == this.selectedOption.value
            //         );
            //     }

            //     let selectedOption = find(
            //         this.currentField.options,
            //         (v) => v.value == this.currentField.value
            //     );

            //     if (isNil(currentSelectedOption)) {
            //         this.clearSelection();

            //         if (this.currentField.value) {
            //             this.selectOption(selectedOption);
            //         } else if (hasValue && !this.currentField.nullable) {
            //             this.selectOption(first(this.currentField.options));
            //         }

            //         return;
            //     } else if (
            //         currentSelectedOption &&
            //         selectedOption &&
            //         ["create", "attach"].includes(this.editMode)
            //     ) {
            //         this.selectOption(selectedOption);

            //         return;
            //     }

            //     this.selectOption(currentSelectedOption);
            // },
        },
    };
</script>
