import { signIn } from "next-auth/react";

export function Loggedout() {
  return (
    <>
      you are currently not signed in, please sign in to be able to use this great application. <br />
      <button onClick={() => signIn()}>Sign in</button>
    </>
  );
}
