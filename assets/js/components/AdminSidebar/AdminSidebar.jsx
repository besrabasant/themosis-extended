import {AdminSidebarContext} from "../../core/contexts";
import {createPortal} from "react-dom";
import {createComponentsFromConfig} from "../../core/component";
import {__SIDEBAR_REACT_ROOT__} from "../../core/Constants";
import {SidebarCtaSlot, SidebarFieldsSlot} from "../../core/slotfills";

const AdminSidebarContainer = ({attributes}) => {
    // let contents = createComponentsFromConfig(attributes)

    return (
        <>
            {/*{contents}*/}
            <div className='admin-page__sidebar-fields-slot'>
                <SidebarFieldsSlot/>
            </div>
            <div className="admin-page__sidebar-cta-slot">
                <SidebarCtaSlot/>
            </div>
        </>
    )
}

export const AdminSidebar = () => {
    return createPortal(
        <AdminSidebarContext.Consumer>
            {(attributes) => (<AdminSidebarContainer attributes={attributes}/>)}
        </AdminSidebarContext.Consumer>
        , document.getElementById(__SIDEBAR_REACT_ROOT__))
}