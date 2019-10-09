import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {dispatch} from '@wordpress/data'
import {Button} from '@wordpress/components'
import TodoList from "./AddTodoList"

export const SidebarTitle = ({attributes}) => {
    return (
        <>
            <div className="admin-page__sidebar-title">{attributes.title}</div>
            <Button isPrimary isLarge onClick={() => dispatch('core/SidebarTitle').increment()}>Increment</Button>
            <Button isPrimary isLarge onClick={() => dispatch('core/SidebarTitle').decrement()}>Decrement</Button>
            <TodoList/>
        </>
    )
}


