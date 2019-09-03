import {withSelect} from "@wordpress/data";

const TodoList = ({count}) => {
    return (<pre>{count}</pre>)
}

const ConnectedComponent = withSelect((select, ownProps) => ({
    count: select('core/SidebarTitle').getCount()
}))(TodoList)

export default ConnectedComponent