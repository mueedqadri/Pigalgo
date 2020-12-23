/**
* WordPress dependencies
*/
const { __ } = wp.i18n;

/**
* Internal dependencies
*/
import GiveHelpLink from '../help-link';
import PlaceholderAnimation from '../placeholder-animation';
import GiveLogo from '../logo';

const GiveBlankSlate = ( props ) => {
	const {
		noIcon,
		isLoader,
		title,
		description,
		children,
		helpLink,
	} = props;

	const blockLoading = (
		<PlaceholderAnimation />
	);

	const blockLoaded = (
		<div className="block-loaded">
			{ !! title && ( <h3 className="give-blank-slate__heading">{ title }</h3> ) }
			{ !! description && ( <p className="give-blank-slate__message">{ description }</p> ) }
			{ children }
			{ !! helpLink && ( <GiveHelpLink /> ) }
		</div>
	);

	return (
		<div className="give-blank-slate">
			{ ! noIcon && <GiveLogo size="80" className="give-blank-slate__image" /> }
			{ !! isLoader ? blockLoading : blockLoaded }
		</div>
	);
};

export default GiveBlankSlate;
