import {AdminHeaderContext, AdminSidebarContext} from "../contexts";
import {AdminHeader} from "../../components/AdminHeader";
import {AdminSidebar} from "../../components/AdminSidebar";
import {dataParser} from "../utils";
import {__HEADER_REACT_ROOT__, __SIDEBAR_REACT_ROOT__} from "../Constants";
import {SlotFillProvider} from '@wordpress/components'

export const AdminPageContainer = ({children}) => {

    let HeaderConfig = dataParser(document.getElementById(__HEADER_REACT_ROOT__).innerHTML)
    let SidebarConfig = dataParser(document.getElementById(__SIDEBAR_REACT_ROOT__).innerHTML)

    return (
        <SlotFillProvider>
            <AdminHeaderContext.Provider value={HeaderConfig}>
                <AdminHeader/>
            </AdminHeaderContext.Provider>
            {children}
            <AdminSidebarContext.Provider value={SidebarConfig}>
                <AdminSidebar/>
            </AdminSidebarContext.Provider>
        </SlotFillProvider>
    )
}