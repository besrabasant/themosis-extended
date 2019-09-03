import {createPortal} from "@wordpress/element";
import {AdminHeaderContext} from "../../core/contexts";
import {__HEADER_REACT_ROOT__} from "../../core/Constants";

const AdminHeaderContainer = ({attributes}) => {
    return (<div className="admin-page__title">{attributes.title}</div>)
}

export const AdminHeader = () => {
    return createPortal(
        <AdminHeaderContext.Consumer>
            {(attributes) => (<AdminHeaderContainer attributes={attributes}/>)}
        </AdminHeaderContext.Consumer>
        , document.getElementById(__HEADER_REACT_ROOT__))
}
