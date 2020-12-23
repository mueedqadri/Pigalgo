/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;
const { Button } = wp.components;

/**
 * Internal dependencies
 */
import { getSiteUrl } from '../../utils';
import GiveBlankSlate from '../blank-slate';

/**
 * Render No forms Found UI
 */

const EditForm = ( { attributes, setAttributes, formId } ) => {
	const changeForm = () => {
		setAttributes( { prevId: attributes.id } );
		setAttributes( { id: 0 } );
	};

	return (
		<GiveBlankSlate title={ __( 'Edit Form.' ) }
			description={ __( 'An error occured with donation form settings that rendered the preview inaccessible.' ) }>
			<Button isPrimary
				isLarge
				target="_blank"
				href={ `${ getSiteUrl() }/wp-admin/post.php?post=${ formId }&action=edit` }>
				{ __( 'Edit Donation Form' ) }
			</Button>
			&nbsp;&nbsp;
			<Button isLarge
				onClick={ changeForm }>
				{ __( 'Change Form' ) }
			</Button>
		</GiveBlankSlate>
	);
};

export default EditForm;
