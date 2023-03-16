const path = require("path");

module.exports = {
    content: [
        path.resolve(__dirname, "resources/**/*.{vue,js,ts,jsx,tsx,scss}"),
        path.resolve(__dirname, "src/NovaInlineSelect.php"),
    ],
    prefix: "mm-",
};
