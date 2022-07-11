/**
 * @WordPress dependencies
 */
// import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import { useCallback, useMemo, useState } from '@wordpress/element';
import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, CheckboxControl } from '@wordpress/components';
/**
 * @Internal dependencies
 */
import metadata from './block.json';
import ItemPreview from './components/ItemPreview';
import ItemSetting from './components/ItemSetting';
import { SearchBtn, UpdateBtn, SimpleLinkBtn } from './components/settingBtns';
import BtnSettingTable from '@blocks/components/BtnSettingTable';
import { getParsedMeta, setCustomFieldArea, sendUpdateAjax } from '@blocks/helper';

/**
 * metadata
 */
const blockName = 'pochipp-block';
const { apiVersion, name, category, keywords, supports } = metadata;
const linkType = {
	shop: 'shop', // amazon or rakuten or yahoo
	simple: 'simple',
};
// ショップのリスト（searched_atのvalue）
const shops = {
	amazon: 'amazon',
	rakuten: 'rakuten',
	yahoo: 'yahoo',
	simple: 'simple',
};

/* eslint no-alert: 0 */
/* eslint no-console: 0 */

/**
 * メタデータ更新処理
 * iframe 側からも呼び出せるようにグローバル化
 *
 * @param {Object} itemData 商品データ
 * @param {boolean} isMerge データをマージして更新するかどうか
 */
window.setItemMetaData = (itemData, isMerge) => {
	// console.log('setItemMetaData:', itemData);

	// 使用するメソッドの準備
	const { editPost } = wp.data.dispatch('core/editor');
	const { getEditedPostAttribute } = wp.data.select('core/editor');

	// タイトル情報の処理
	if (itemData.title) {
		// 更新
		editPost({ title: itemData.title });

		// metaには保存しない
		delete itemData.title;
	}

	// metaの取得
	const oldMeta = getEditedPostAttribute('meta');

	let newItemData = {};
	if (isMerge) {
		const oldItemData = getParsedMeta(oldMeta.pochipp_data);
		newItemData = { ...oldItemData, ...itemData };
	} else {
		newItemData = itemData;
	}

	// 新しいデータをjson文字列化
	const newItemJson = JSON.stringify(newItemData);

	// metaの更新 （他のmetaデータを持つ場合を考慮し、'pochipp_data' だけ対象に上書き）
	editPost({ meta: { ...oldMeta, pochipp_data: newItemJson } });

	// metaの更新 : gutenberのバグ対処用
	setCustomFieldArea('pochipp_data', newItemJson);

	// ブロックのattributesを更新する
	// const { updateBlockAttributes } = wp.data.dispatch('core/block-editor');
	// updateBlockAttributes(clientId, {
	// 	metadata: JSON.stringify(itemData),
	// });
};

// 商品データ更新処理
const updateItem = (itemCode, searchedAt) => {
	const params = new URLSearchParams();
	params.append('action', 'pochipp_update_data');
	params.append('itemcode', itemCode);
	params.append('searched_at', searchedAt);

	const btns = document.querySelector('.pochipp-block--setting .__btns');
	btns.classList.add('-updating');

	const doneFunc = (response) => {
		const itemData = response.data;
		window.setItemMetaData(itemData, true);

		alert('更新が完了しました！');
		btns.classList.remove('-updating');
	};
	const failFunc = (err) => {
		alert('更新に失敗しました。');
		console.error(err);
		btns.classList.remove('-updating');
	};

	// ajax処理
	sendUpdateAjax(params, doneFunc, failFunc);
};

/**
 * ポチップ登録用のブロック
 */
registerBlockType(name, {
	apiVersion,
	title: '商品データ',
	icon: 'pets',
	category,
	keywords,
	supports,
	attributes: metadata.attributes,
	edit: ({ attributes, setAttributes, clientId }) => {
		// メタデータを取得
		const { meta } = attributes;
		const parsedMeta = useMemo(() => getParsedMeta(meta), [meta]);
		const {
			searched_at: searchedAt,
			image_id: customImgId = 0,
			custom_btn_text: customBtnText = '',
			custom_btn_url: customBtnUrl = '',
			custom_btn_text_2: customBtnText2 = '',
			custom_btn_url_2: customBtnUrl2 = '',
			asin: amazonAsin = '',
			amazon_affi_url: amazonAffiUrl = '',
			itemcode = '',
			is_all_search_result: isAllSearchResult = false,
		} = parsedMeta;
		// console.log(meta, parsedMeta);

		const [isStickey, setIsStickey] = useState(false);
		const [selectedLinkType, setSelectedLinkType] = useState(searchedAt === shops.simple ? linkType.simple : linkType.shop);

		// 投稿ID・投稿タイプを取得
		const { postId } = useSelect((select) => {
			return {
				postId: select('core/editor').getCurrentPostId(),
				// postType: select('core/editor').getCurrentPostType(),
			};
		}, []);

		// タイトル更新用関数
		const { editPost } = wp.data.dispatch('core/editor');

		// 投稿タイトルを取得
		// memo: getCurrentPostAttribute は編集時のデータは取得できない。 getEditedPostAttribute だとOK。
		const postTitle = useSelect((select) => select('core/editor').getEditedPostAttribute('title'), []);

		const customImgUrl = useSelect(
			(select) => {
				if (!customImgId) return '';
				const mediaData = select('core').getMedia(customImgId);
				return mediaData ? mediaData.source_url : '';
			},
			[customImgId]
		);
		// console.log(customImgUrl);

		const updateMetadata = useCallback(
			(data) => {
				const newPochippMeta = JSON.stringify({ ...parsedMeta, ...data });

				// meta更新
				// setMeta({ ...meta, pochipp_data: newPochippMeta });
				setAttributes({ meta: newPochippMeta });
				setCustomFieldArea('pochipp_data', newPochippMeta); // gutenberのバグにも対応
			},
			[parsedMeta]
		);

		// 商品検索
		const openThickbox = useCallback(
			(only = '') => {
				let url = 'media-upload.php?type=pochipp';
				url += `&at=setting`;
				// url += `&tab=pochipp_search_${type}`;
				url += `&blockid=${clientId}`;
				url += `&postid=${postId}`;
				if (only) {
					url += `&tab=pochipp_search_${only}`;
					url += `&only=${only}`;
				} else {
					url += `&tab=pochipp_search_amazon`;
				}
				url += '&TB_iframe=true'; //これは最後に。

				// #TB_window を開く
				window.tb_show('商品検索', url);

				// 開いた #TB_window を取得してクラス追加
				const tbWindow = document.querySelector('#TB_window');

				if (tbWindow) {
					tbWindow.classList.add('by-pochipp');
				}
			},
			[postId, clientId]
		);

		// simpleリンク作成が選択された場合
		const selectCreateSimpleLink = (imageId) => {
			setSelectedLinkType(linkType.simple);
			// titleと初期の値を入力
			if (!postTitle) {
				editPost({ title: '【商品タイトル】タイトルを入力してください' });
			}

			updateMetadata({
				searched_at: shops.simple,
				image_id: imageId,
				custom_btn_text: customBtnText || '公式サイトで探す',
				custom_btn_url: customBtnUrl || 'https://example.com',
				custom_btn_text_2: customBtnText2 || '近くのお店で探す',
				custom_btn_url_2: customBtnUrl2 || 'https://example.com',
			});
		};

		// 商品が検索された状態かどうか
		const hasSearchedItem = !!searchedAt;

		// 商品リンクがamazon, rakuten, yahooで検索されたリンクかどうか
		const isShopLinkType = selectedLinkType === linkType.shop;

		// 商品検索ボタンを表示するかどうか
		const showSearchBtn = !hasSearchedItem || isShopLinkType;

		// リンク作成ボタンを表示するかどうか
		const showSimpleLinkBtn = !hasSearchedItem || selectedLinkType === linkType.simple;

		// 情報更新ボタンが表示可能か判定するためのオブジェクト
		const itemInfoForUpdate = {
			[shops.amazon]: {
				itemCode: amazonAsin,
				showUpdateBtn: !!(amazonAsin && amazonAffiUrl),
			},
			[shops.rakuten]: {
				itemCode: itemcode,
				showUpdateBtn: !!itemcode,
			},
			default: {
				itemCode: '',
				showUpdateBtn: false,
			},
		};
		const { itemCode, showUpdateBtn } = itemInfoForUpdate[searchedAt] || itemInfoForUpdate.default;

		// 商品データ更新処理
		const updateItemData = useCallback(() => updateItem(itemCode, searchedAt), [itemCode, parsedMeta]);

		return (
			<>
				<div
					{...useBlockProps({
						className: `${blockName}--setting`,
						'data-sticky': isStickey ? '1' : null,
					})}
				>
					<ItemPreview {...{ postTitle, customImgUrl, parsedMeta }} />
					<div className='__settings'>
						<div className='__btns'>
							{showSearchBtn && (
								<>
									<SearchBtn onClick={openThickbox} text={hasSearchedItem ? '商品を再検索' : '商品を検索'} />
									{showUpdateBtn && <UpdateBtn onClick={updateItemData} />}
								</>
							)}
							{showSimpleLinkBtn && (
								<SimpleLinkBtn
									text={hasSearchedItem ? 'リンクを再作成' : '手動でリンクを作成'}
									imageId={customImgId}
									selectCreateSimpleLink={selectCreateSimpleLink}
								/>
							)}
						</div>
						{hasSearchedItem && (
							<div className='__fields'>
								{isShopLinkType && (
									<div className='components-base-control'>
										<div className='components-base-control__label'>ボタンリンク先</div>
										<BtnSettingTable
											attrs={parsedMeta}
											openThickbox={openThickbox}
											deleteAmazon={() => {
												updateMetadata({ asin: '' });
												updateMetadata({ amazon_affi_url: '' });
											}}
											deleteRakuten={() => {
												updateMetadata({ itemcode: '' });
												updateMetadata({ rakuten_detail_url: '' });
											}}
											deleteYahoo={() => {
												updateMetadata({ yahoo_itemcode: '' });
												updateMetadata({ seller_id: '' });
												updateMetadata({ is_paypay: '' });
												updateMetadata({ yahoo_detail_url: '' });
											}}
										/>
										<CheckboxControl
											className='__searchResultCheck'
											label='リンク先をすべて検索結果ページにする'
											checked={isAllSearchResult}
											onChange={(checked) => {
												updateMetadata({ is_all_search_result: checked });
											}}
										/>
									</div>
								)}
								<ItemSetting {...{ postTitle, parsedMeta, updateMetadata, customImgUrl, isShopLinkType }} />
							</div>
						)}
						{/* <div>【開発用】データ確認</div>
					<div className='pochipp-block-dump'>
						{Object.keys(parsedMeta).map((metakey) => {
							return (
								<div key={metakey}>
									<code>{metakey}</code> :{' '}
									{String(parsedMeta[metakey])}
								</div>
							);
						})}
					</div> */}
					</div>
				</div>
				<InspectorControls>
					<PanelBody>
						<CheckboxControl
							label='プレビューを画面上部に固定表示'
							checked={isStickey}
							onChange={(checked) => {
								setIsStickey(checked);
							}}
						/>
					</PanelBody>
				</InspectorControls>
			</>
		);
	},

	save: () => {
		return null;
	},
});
