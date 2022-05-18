import { useAnchorRef } from '@wordpress/rich-text';
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { useState } from 'react';
import Popover from './components/Popover';

export default ({ name, title, contentRef, isActive, value, onChange }) => {
	const [adding, setIsAdding] = useState(false);
	const [keyword, setKeyword] = useState('');

	const anchorRef = useAnchorRef({
		ref: contentRef,
		value,
	});

	const closePopover = () => {
		setIsAdding(false);
	};

	return (
		<>
			<RichTextToolbarButton name={name} icon='pets' title={title} isActive={isActive} onClick={() => setIsAdding(true)} />
			{adding && (
				<Popover
					value={value}
					anchorRef={anchorRef}
					keyword={keyword}
					setKeyword={setKeyword}
					onChange={onChange}
					closePopover={closePopover}
				/>
			)}
		</>
	);
};
