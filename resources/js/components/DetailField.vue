<template>
    <div
        class="flex flex-col px-6 py-2 -mx-6 space-y-2 md:flex-row md:py-0 md:space-y-0"
        dusk="id"
    >
        <div class="md:w-1/4 md:py-3">
            <h4 class="font-normal">
                <span>
                    {{ field.name }}
                </span>
            </h4>
        </div>
        <div class="break-all md:w-3/4 md:py-3 lg:break-words">
            <NovaInlineSelect
                :index="index"
                :resource="resource"
                :resourceName="resourceName"
                :resourceId="resourceId"
                :showLabel="this.field.showLabelOnDetail"
                :maxWidth="this.field.maxWidthOnDetail"
                :showArrows="this.field.showArrowsOnDetail"
                :live="true"
                :field="field"
            />
        </div>
    </div>
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
