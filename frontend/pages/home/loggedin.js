import style from "./loggedin.module.css"
import Link from "next/link";
import { signOut } from "next-auth/react";

export function Loggedin(props) {
    const session = props.session;
  return (
    <div>
      greetings { session.user.email} ! <br />
      <pre className={style.code}>{JSON.stringify(session, null, 2)}</pre>
      <br />
      <button className={style.button} onClick={() => signOut()}>Sign out</button>
      <div>
        <Link href="/calander">
          <h1>create agenda feed</h1>
        </Link>
        <Link href="/test">
          <h1>testing page</h1>
        </Link>
        
      </div>
    </div>
  );
}
