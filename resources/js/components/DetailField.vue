<template>
    <div
        class="flex flex-col md:flex-row -mx-6 px-6 py-2 md:py-0 space-y-2 md:space-y-0"
        dusk="id"
    >
        <div class="md:w-1/4 md:py-3">
            <h4 class="font-normal">
                <span>
                    {{ field.name }}
                </span>
            </h4>
        </div>
        <div class="md:w-3/4 md:py-3 break-all lg:break-words">
            <NovaInlineSelect
                :index="index"
                :resource="resource"
                :resourceName="resourceName"
                :resourceId="resourceId"
                :showLabel="this.field.showLabelOnDetail"
                :maxWidth="this.field.maxWidthOnDetail"
                :showArrows="this.field.showArrowsOnDetail"
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
