<template>
    <NovaInlineSelect
        :index="index"
        :resource="resource"
        :resourceName="resourceName"
        :resourceId="this.$parent.resource.id.value"
        :showLabel="this.field.showLabelOnIndex"
        :maxWidth="this.field.maxWidthOnIndex"
        :showArrows="this.field.showArrowsOnIndex"
        :field="field"
        :live="true"
    />
</template>

<script>
    import NovaInlineSelect from "./NovaInlineSelect.vue";
    export default {
        components: {
            NovaInlineSelect,
        },

        props: ["index", "resource", "resourceName", "resourceId", "field"],
    };
</script>
