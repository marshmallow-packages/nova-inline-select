import IndexField from "./components/IndexField";
import DetailField from "./components/DetailField";
import FormField from "./components/FormField";
import NovaInlineSelect from "./components/NovaInlineSelect";

Nova.booting((app, store) => {
    app.component("index-nova-inline-select", IndexField);
    app.component("detail-nova-inline-select", DetailField);
    app.component("form-nova-inline-select", FormField);
    app.component("marshmallow-nova-inline-select", NovaInlineSelect);
});
