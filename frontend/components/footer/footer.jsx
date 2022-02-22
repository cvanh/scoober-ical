import style from "./footer.module.css"

export default function Footer(){
    return(
        <>
        created by constantijn van hartesveldt
        <div className={style.smalltext}>please dont sue me for creating this, you can find the source code on my github profile <a href="https://github.com/cvanh">github</a></div>
        </>
    )
}