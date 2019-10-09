import {SidebarFieldsFill} from "../../core/slotfills";
import {__} from "@wordpress/i18n"

export const TableOptions = () => {
    return (
        <SidebarFieldsFill>
            <form action="">
                <div className="admin-page__table-options table-options">
                    <div className="table-options__title">
                        {__('Table options')}
                    </div>
                </div>
            </form>
        </SidebarFieldsFill>
    )
}