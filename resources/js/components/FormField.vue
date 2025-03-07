<template>
    <DefaultField
        :field="field"
        :errors="errors"
        :show-help-text="showHelpText"
        :full-width-content="fullWidthContent"
    >
        <template #field>
            <NovaInlineSelect
                :resource="resource"
                :resourceName="resourceName"
                :resourceId="this.resourceId"
                :showLabel="this.field.showLabelOnIndex"
                :maxWidth="this.field.maxWidthOnIndex"
                :showArrows="this.field.showArrowsOnIndex"
                :live="false"
                :field="field"
            />
        </template>
    </DefaultField>
</template>
<script>
    import NovaInlineSelect from "./NovaInlineSelect.vue";
    import { FormField, HandlesValidationErrors } from "laravel-nova";

    export default {
        mixins: [FormField, HandlesValidationErrors],

        components: {
            NovaInlineSelect,
        },

        created() {
            let self = this;
            Nova.$on("novaInlineSelectSetFormFieldValue", function (data) {
                self.setValue(data.value);
            });
        },

        methods: {
            setInitialValue() {
                this.value = this.field.value || "";
            },

            fill(formData) {
                formData.append(this.fieldAttribute, this.value || "");
            },

            setValue(value) {
                this.value = value;
            },
        },

        props: ["resourceName", "field", "resourceId"],
    };
</script>
