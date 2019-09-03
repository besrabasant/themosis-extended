export default ({info}) => {
    return (info) ?
        (<div className='th-description field__description'>
            <small>{info}</small>
        </div>)
        :
        null
}