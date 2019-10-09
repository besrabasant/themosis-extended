import {AdminTableContext} from "../../core/contexts";

export const ShowTableExtraContent = ({label, item}) => {
    return (
        <AdminTableContext.Consumer>
            {
                ({Handlers}) => {
                    return (<button className="btn btn-primary" data-row-item={item.id}
                                    onClick={Handlers.toggleExtraContent}>{label}</button>)
                }
            }
        </AdminTableContext.Consumer>
    )
}

ShowTableExtraContent.defaultProps = {
    label: "Show content"
}

export const HideTableExtraContent = ({label, item}) => {
    return (
        <AdminTableContext.Consumer>
            {
                ({Handlers}) => {
                    return (<button className="btn btn-link"
                                    onClick={Handlers.hideExtraContent}>{label}</button>)
                }
            }
        </AdminTableContext.Consumer>
    )
}

HideTableExtraContent.defaultProps = {
    label: "Hide content"
}