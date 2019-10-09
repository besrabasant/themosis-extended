import {Spinner} from '@wordpress/components'

export const Loading = ({text}) => {
    return (
        <div className="loading loading--overlay">
            <div className="loading__body">
                <Spinner/>
                {text}
            </div>
        </div>
    )
}

Loading.defaultProps = {
    text: ""
}