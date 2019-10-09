import {map} from 'lodash'
import classNames from 'classnames'

export const TableViews = ({views}) => {
    return (views) ? (
        <div className="table-views">
            {
                map(views, function (view, key) {

                    let viewItemClasses = classNames('table-views__item', `table-views__item--${key}`, {
                        'table-views__item--active': view.active
                    });

                    return (
                        <div key={key} className={viewItemClasses}>
                            <a className="table-views__link" href={view.link}
                               dangerouslySetInnerHTML={{__html: view.label}}/>
                        </div>
                    );
                })
            }
        </div>
    ) : null
}