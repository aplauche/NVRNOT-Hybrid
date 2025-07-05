/**
 * Dependencies
 */
const { join } = require('path');

module.exports = {
	defaultValues: {
		author: 'nvrnot',
		dashicon: 'pets',
		description: 'A custom block created by the create-block for the theme',
		namespace: 'nvrnot',
		render: 'file:./render.php',
		version: '1.0.0'
	},
	variants: {
		dynamic: {

		},
		innerblocks: {

		},
		static: {

		}
	},
	pluginTemplatesPath: join(__dirname, 'plugin'),
	blockTemplatesPath: join(__dirname, 'block'),
};
