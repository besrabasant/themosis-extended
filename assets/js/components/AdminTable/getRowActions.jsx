import {reduce} from 'lodash'
import {__} from "@wordpress/i18n"

let DEFAULT_ACTIONS = {
    edit: __("Edit"),
    archive: __("Archive"),
    unarchive: __("Unarchive"),
    delete: __("Delete")
};

export function getRowActions(actions) {

    return (
        <div className="table__row-actions">
            {reduce(DEFAULT_ACTIONS, (columnActions, actionName, actionKey) => {

                if (actions.hasOwnProperty(actionKey)) {
                    columnActions.push((
                        <a key={`action-${actionKey}`} href={actions[actionKey]}
                           className={`table__row-action table__row-action--${actionKey}`}>
                            {actionName}
                        </a>
                    ))
                }

                return columnActions
            }, [])}
        </div>
    )
}