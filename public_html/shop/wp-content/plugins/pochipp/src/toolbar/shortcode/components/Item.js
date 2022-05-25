import { Button } from '@wordpress/components';
import { insert } from '@wordpress/rich-text';

const shops = {
	amazon: 'Amazon',
	rakuten: '楽天',
	yahoo: 'Yahoo',
};

const generateCvkey = () => {
	const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	const length = 8;
	return Array.from(Array(length))
		.map(() => characters[Math.floor(Math.random() * characters.length)])
		.join('');
};

export default ({ value, item, onChange, closePopover }) => {
	const { hasAffi } = window.pchppVars;
	const hasPro = window.pchppProVars !== undefined;
	const isAllHidden = hasAffi && Object.values(hasAffi).every((v) => v === '');
	const cvKeyTag = hasPro ? ` cvkey="${generateCvkey()}"` : '';

	return (
		<div className='pochipp-popover__card'>
			<div className='pochipp-popover__card-image'>
				<img src={item.image} width={100} height={100} alt='' />
			</div>
			<div className='pochipp-popover__card-body'>
				<p className='pochipp-popover__card-description'>{item.title}</p>
				<div className='pochipp-popover__card-btns'>
					{isAllHidden && (
						<div className='pochipp-popover__disabled'>
							<a href='https://pochipplocal.local/wp-admin/edit.php?post_type=pochipps&page=pochipp_settings&tab=basic'>
								ポチップ設定ページ
							</a>
							から、各ショップの「アフィリエイト設定」を行ってください。
						</div>
					)}
					{Object.entries(shops).map(([shop, label]) => {
						const showBtn = hasAffi && hasAffi[shop];

						return (
							showBtn && (
								<Button
									key={`btn-${shop}`}
									text={label}
									isSecondary
									onClick={() => {
										closePopover();
										onChange(
											insert(
												value,
												`[pochipp_btn id="${item.pid}" shop="${shop}"${cvKeyTag}]${label}[/pochipp_btn]`,
												value.start,
												value.end
											)
										);
									}}
								/>
							)
						);
					})}
					{item.customBtnText && item.customBtnUrl && (
						<Button
							text={item.customBtnText}
							isSecondary
							onClick={() => {
								closePopover();
								onChange(
									insert(
										value,
										`[pochipp_btn id="${item.pid}" shop="custom1"${cvKeyTag}"]${item.customBtnText}[/pochipp_btn]`,
										value.start,
										value.end
									)
								);
							}}
						/>
					)}
					{item.customBtnText2 && item.customBtnUrl2 && (
						<Button
							text={item.customBtnText2}
							isSecondary
							onClick={() => {
								closePopover();
								onChange(
									insert(
										value,
										`[pochipp_btn id="${item.pid}" shop="custom2"${cvKeyTag}]${item.customBtnText2}[/pochipp_btn]`,
										value.start,
										value.end
									)
								);
							}}
						/>
					)}
				</div>
			</div>
		</div>
	);
};
