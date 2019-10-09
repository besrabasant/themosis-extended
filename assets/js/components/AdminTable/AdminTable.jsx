import {TableHead} from "./TableHead";
import {TableBody} from "./TableBody";
import {TableFilters} from "./TableFilters";
import {TableViews} from "./TableViews";
import {TablePagination} from "./TablePagination";
import {TableOptions} from "./TableOptions";
import {AdminTableContext} from "../../core/contexts";
import {useState} from "@wordpress/element";

export const AdminTable = ({tableData}) => {

    let initialState = {
        showExtraContent: null
    }

    let [state, setState] = useState(initialState)

    let ContextHandlers = {
        toggleExtraContent(e) {
            if ((parseInt(e.target.dataset.rowItem)) === state.showExtraContent) {
                ContextHandlers.hideExtraContent(e)
            } else {
                ContextHandlers.showExtraContent(e)
            }
        },
        showExtraContent(e) {
            setState({...state, showExtraContent: parseInt(e.target.dataset.rowItem)})
        },
        hideExtraContent(e) {
            setState({...state, showExtraContent: null})
        }
    }

    let ContextData = {
        State: state,
        Handlers: ContextHandlers
    }

    return (
        <AdminTableContext.Provider value={ContextData}>
            <div className="table__top">
                <TableViews views={tableData.views}/>
                <TablePagination attributes={tableData.paginate}/>
            </div>
            <table id={tableData.attributes.id} className={`table table-bordered table--${tableData.attributes.id}`}>
                <TableHead attributes={tableData.attributes} columns={tableData.columns}/>
                <TableBody attributes={tableData.attributes} columns={tableData.columns} rows={tableData.rows}/>
            </table>
            <TableOptions/>
            <TableFilters attributes={tableData.attributes} filters={tableData.filters}
                          applied_filters={tableData.applied_filters} tableData={tableData}/>
        </AdminTableContext.Provider>
    )
}