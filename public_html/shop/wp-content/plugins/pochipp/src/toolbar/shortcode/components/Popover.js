import { Popover, TextControl } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import Item from './Item';

export default ({ value, anchorRef, keyword, setKeyword, onChange, closePopover }) => {
	const [items, setItems] = useState([]);

	// キーワード検索された時
	const fetchRegisteredItems = async (searchWord) => {
		// とりあえず5つを上限として返却する
		setItems(await doAjaxRequest({ keywords: searchWord, count: 5 }));
	};

	// 初期状態で表示するリスト
	const fetchRegisteredItemsDefault = async () => {
		setItems(await doAjaxRequest({ count: 5 }));
	};

	useEffect(() => {
		fetchRegisteredItemsDefault();
	}, []);

	return (
		<Popover
			anchorRef={anchorRef}
			className='pochipp-popover'
			position='bottom center'
			onClose={() => {
				closePopover();
			}}
		>
			<div className='pochipp-popover__title'>Pochipp インラインボタン</div>
			<div className='pochipp-popover__body'>
				<TextControl
					className='pochipp-popover__search'
					placeholder='登録済み商品をキーワードで検索...'
					value={keyword}
					onChange={(newText) => {
						setKeyword(newText);
						fetchRegisteredItems(keyword);
					}}
				/>
				<div className='pochipp-popover__list'>
					{items.map((item) => (
						<Item key={item.pid} value={value} item={item} onChange={onChange} closePopover={closePopover} />
					))}
				</div>
			</div>
		</Popover>
	);
};

const doAjaxRequest = async (args) => {
	const action = 'pochipp_search_registerd';
	const { ajaxUrl, ajaxNonce } = window.pchppVars;
	const params = {
		action,
		nonce: ajaxNonce,
		...args,
	};
	const query = new URLSearchParams(params);

	const response = await fetch(`${ajaxUrl}?${query}`, {
		method: 'GET',
		cache: 'no-cache',
	}).then((res) => {
		if (res.ok) {
			return res.json();
		}
		throw new TypeError('Failed ajax!');
	});

	return response.registerd_items.map((item) => ({
		pid: item.post_id,
		title: item.title,
		image: item.custom_image_url || item.image_url,
		customBtnText: item.custom_btn_text || '',
		customBtnUrl: item.custom_btn_url || '',
		customBtnText2: item.custom_btn_text_2 || '',
		customBtnUrl2: item.custom_btn_url_2 || '',
	}));
};
