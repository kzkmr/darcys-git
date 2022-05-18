import { registerFormatType } from '@wordpress/rich-text';
import { BlockControls } from '@wordpress/block-editor';
import { Slot } from '@wordpress/components';

// toolbarに表示する項目
import editShortcode from './shortcode';

const slots = [
	{
		fill: 'pochipp-inline-button',
		format: 'pochipp/inline-button',
		title: 'インラインボタン',
		tagName: 'inline-button',
		edit: (args) => editShortcode({ name: 'pochipp-inline-button', title: 'インラインボタン', ...args }),
	},
];

// toolbarに表示するSlot
registerFormatType('pochipp/inline-tools', {
	title: 'pochippインラインツール',
	tagName: 'pochipp-inline-tools',
	className: null,
	edit: () => {
		return (
			<BlockControls group='other'>
				{slots.map((slot) => (
					<Slot name={`RichText.ToolbarControls.${slot.fill}`} key={slot.fill} />
				))}
			</BlockControls>
		);
	},
});

// Slot内に表示するRichText
slots.forEach((slot) => {
	registerFormatType(slot.format, {
		title: slot.title,
		tagName: slot.tagName,
		className: null,
		edit: slot.edit,
	});
});
