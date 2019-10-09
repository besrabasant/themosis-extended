import classNames from 'classnames'
import {createSwitchCase} from "../../core/utils";

function getPaginationItem(url, attributes, label = '', disabled = false) {

    let itemClasses = classNames('page-item', {
        'disabled': disabled
    })

    return (
        <li className={itemClasses}>
            <a className="page-link" href={url}>
                <span className="screen-reader-text" dangerouslySetInnerHTML={{__html: label}}/>
            </a>
        </li>
    )
}


export const TablePagination = ({attributes}) => {
    return (attributes.last_page > 1) ? (
        <nav className="table__pagination">
            <ul className="pagination">
                {getPaginationItem(attributes.first_page_url, attributes, '&laquo;', (attributes.current_page <= 2))}
                {getPaginationItem(attributes.prev_page_url, attributes, '&lsaquo;', (attributes.current_page === 1))}
                <li className="table__pagination-current">
                    <input type="text" className="form-control" defaultValue={attributes.current_page}/>
                </li>
                <li className="table__pagination-total">
                    of {attributes.last_page}
                </li>
                {getPaginationItem(attributes.next_page_url, attributes, '&rsaquo;', (attributes.current_page === attributes.last_page))}
                {getPaginationItem(attributes.last_page_url, attributes, '&raquo;', (attributes.current_page >= (attributes.last_page - 1)))}
            </ul>
        </nav>
    ) : null
}