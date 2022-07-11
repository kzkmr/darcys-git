/**
 * @WordPress dependencies
 */
import { memo } from '@wordpress/element';
import ServerSideRender from '@wordpress/server-side-render';

// 価格の表示を行う判定を取得
const getDispPrice = (isShowCommonSetting, isShowIndivisualSetting, isHideIndivisualSetting) => {
	if (isShowIndivisualSetting) {
		return true;
	}
	if (isHideIndivisualSetting) {
		return false;
	}
	return isShowCommonSetting;
};

/**
 * ItemPreview
 */
export default memo(({ postTitle, customImgUrl, parsedMeta }) => {
	// 投稿タイトルもmeta情報も持たないとき。
	if (!postTitle && 0 === Object.keys(parsedMeta).length) {
		return (
			<div className='__preview -null'>
				<p>商品を選択してください</p>
			</div>
		);
	}

	const { info, price, showPrice, hidePrice, image_url: imageUrl, price_at: priceAt, searched_at: searchedAt } = parsedMeta;

	// ポチップ設定データ
	const pchppVars = window.pchppVars || {};

	let dataBtnStyle = pchppVars.btnStyle || 'dflt';
	if ('default' === dataBtnStyle) dataBtnStyle = 'dflt';

	const dispPrice = getDispPrice(pchppVars.displayPrice !== 'off', showPrice, hidePrice);

	return (
		<div className='__preview'>
			<div
				className='pochipp-box'
				data-img={pchppVars.imgPosition || 'l'}
				data-lyt-pc={pchppVars.boxLayoutPC || 'dflt'}
				data-lyt-mb={pchppVars.boxLayoutMB || 'vrtcl'}
				data-btn-style={dataBtnStyle}
				data-btn-radius={pchppVars.btnRadius || 'off'}
			>
				<div className='pochipp-box__image'>
					<img src={customImgUrl || imageUrl} alt='' />
				</div>
				<div className='pochipp-box__body'>
					<div className='pochipp-box__title'>{postTitle}</div>
					{info && <div className='pochipp-box__info'>{info}</div>}
					{price && dispPrice && (
						<div className='pochipp-box__price'>
							¥{price.toLocaleString()}
							<span>
								（{priceAt}時点 | {searchedAt}調べ）
							</span>
						</div>
					)}
					<ServerSideRender
						block='pochipp/setting-preview'
						attributes={{ meta: JSON.stringify(parsedMeta) }}
						className={`_components-disabled`}
					/>
				</div>
			</div>
			<div className='__helpText'>※ このプレビュー内のボタンはアフィリエイトリンク化されていません。</div>
		</div>
	);
});
