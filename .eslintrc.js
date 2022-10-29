module.exports = {
    "env": {
        "browser": true,
        "es2021": true,
        "node": true
    },
    "extends": [
        "eslint:recommended",
        "plugin:vue/vue3-essential"
    ],
    "overrides": [
    ],
    "parserOptions": {
        "sourceType": "module"
    },
    "plugins": [
        "vue"
    ],
    "rules": {
        // 小規模のため単一語のファイル名も許可
        "vue/multi-word-component-names": "off"
    },
    "globals": {
        // Ziggy.jsのroute関数を設定
        "route": "true"
    }
};
