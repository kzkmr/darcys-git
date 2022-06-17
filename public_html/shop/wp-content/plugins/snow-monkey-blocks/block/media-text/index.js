import { __ } from '@wordpress/i18n';

import blockConfig from '@smb/config/block';
import metadata from './block.json';
import icon from './icon';
import edit from './edit';
import save from './save';
import deprecated from './deprecated';
import example from './example';

const { name } = metadata;

export { metadata, name };

export const settings = {
	icon: {
		foreground: blockConfig.blockIconColor,
		src: icon,
	},
	keywords: [
		__( 'Image', 'snow-monkey-blocks' ),
		__( 'Video', 'snow-monkey-blocks' ),
		__( 'Media & sentence', 'snow-monkey-blocks' ),
	],
	edit,
	save,
	deprecated,
	example,
};
