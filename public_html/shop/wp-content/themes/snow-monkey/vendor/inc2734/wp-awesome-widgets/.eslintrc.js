const defaultConfig = require("@wordpress/scripts/config/.eslintrc.js");

module.exports = {
	...defaultConfig,
	globals: {
		...defaultConfig.globals,
		wpaw: true,
	},
	rules: {
		...defaultConfig.rules,
		'import/no-extraneous-dependencies': 'off',
		'import/no-unresolved': 'off',
		'@wordpress/no-unsafe-wp-apis': 'off',
	},
};
