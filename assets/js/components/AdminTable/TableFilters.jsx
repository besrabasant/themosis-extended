import {SidebarFieldsFill} from "../../core/slotfills";
import {renderFields} from "../AdminForm";
import {__} from '@wordpress/i18n'


function maptoFilters(filterFields, appliedFilters) {
    return function (filtersRenderer) {
        filterFields.forEach(field => {
            field.name = `filters[${field.name}]`
            field.value = appliedFilters[field.basename]
        })

        return filtersRenderer(filterFields)
    }
}

export const TableFilters = ({attributes, filters, applied_filters, tableData}) => {
    return (filters.fields.length) ? (
        <>
            <SidebarFieldsFill>
                <form action={attributes.filters_base_url} method="POST">
                    <input type="hidden" name="page" value={attributes.page}/>
                    <div className="admin-page__table-filters table-filters">
                        <div className="table-filters__title">{__('Table filters')}</div>
                        <div className="table-filters__content">
                            {maptoFilters(filters.fields, applied_filters)(renderFields)}
                            <input type="submit" className="components-button is-button is-primary is-large"
                                   name="submit_filter" value={__('Filter')}/>
                        </div>
                    </div>
                </form>
            </SidebarFieldsFill>
        </>
    ) : null
}