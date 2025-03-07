Nova.booting((Vue) => {
    Vue.component(
        "index-nova-inline-select",
        require("./components/IndexField").default
    );
    Vue.component(
        "detail-nova-inline-select",
        require("./components/DetailField").default
    );
    Vue.component(
        "form-nova-inline-select",
        require("./components/FormField").default
    );
    Vue.component(
        "marshmallow-nova-inline-select",
        require("./components/NovaInlineSelect").default
    );
});
