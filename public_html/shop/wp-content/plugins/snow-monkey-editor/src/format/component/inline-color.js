import { get } from 'lodash';

import {
	__experimentalColorGradientControl as ColorGradientControl,
	URLPopover,
	getColorClassName,
	getColorObjectByColorValue,
	getColorObjectByAttributeValues,
} from '@wordpress/block-editor';
import { withSpokenMessages } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useCallback, useMemo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import {
	applyFormat,
	removeFormat,
	getActiveFormat,
} from '@wordpress/rich-text';

import { useMultipleOriginColorsAndGradients } from '../../hooks/hooks';
import { useAnchorRef } from './use-anchor-ref';

export function getActiveColor( formatName, formatValue, colors ) {
	const activeColorFormat = getActiveFormat( formatValue, formatName );
	if ( ! activeColorFormat ) {
		return;
	}
	const styleColor = activeColorFormat.attributes.style;
	if ( styleColor ) {
		return styleColor.replace( new RegExp( `^color:\\s*` ), '' );
	}
	const currentClass = activeColorFormat.attributes.class;
	if ( currentClass ) {
		const colorSlug = currentClass.replace(
			/.*has-([^\s]*)-color.*/,
			'$1'
		);
		return getColorObjectByAttributeValues( colors, colorSlug ).color;
	}
}

const ColorPicker = ( { name, value, onChange, onClose } ) => {
	const colors = useSelect( ( select ) => {
		const { getSettings } = select( 'core/block-editor' );
		return get( getSettings(), [ 'colors' ], [] );
	} );

	const onColorChange = useCallback(
		( color ) => {
			if ( color ) {
				const colorObject = getColorObjectByColorValue( colors, color );
				onChange(
					applyFormat( value, {
						type: name,
						attributes: colorObject
							? {
									class: getColorClassName(
										'color',
										colorObject.slug
									),
							  }
							: {
									style: `color: ${ color }`,
							  },
					} )
				);
			} else {
				onChange( removeFormat( value, name ) );
				onClose();
			}
		},
		[ colors, onChange ]
	);

	const activeColor = useMemo( () => getActiveColor( name, value, colors ), [
		name,
		value,
		colors,
	] );

	const multipleOriginColorsAndGradients = useMultipleOriginColorsAndGradients();

	return (
		<ColorGradientControl
			label={ __( 'Color', 'snow-monkey-editor' ) }
			colorValue={ activeColor }
			onColorChange={ onColorChange }
			{ ...multipleOriginColorsAndGradients }
			__experimentalHasMultipleOrigins={ true }
			__experimentalIsRenderedInSidebar={ true }
		/>
	);
};

const InlineColorUI = ( {
	name,
	value,
	onChange,
	onClose,
	contentRef,
	settings,
} ) => {
	const anchorRef = useAnchorRef( { ref: contentRef, value, settings } );
	return (
		<URLPopover
			value={ value }
			onClose={ onClose }
			className="sme-popover sme-popover--inline-color components-inline-color-popover"
			anchorRef={ anchorRef }
		>
			<ColorPicker
				name={ name }
				value={ value }
				onChange={ onChange }
				onClose={ onClose }
			/>
		</URLPopover>
	);
};

export default withSpokenMessages( InlineColorUI );
