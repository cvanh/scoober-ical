import { useSession } from "next-auth/react";
import Footer from "../../components/footer";
import Header from "../../components/header";
import { Loggedin } from "../../components/home/loggedin";
import { Loggedout } from "../../components/home/loggedout";

export default function Home() {
  const { data: session } = useSession();
  if (session) {
    return (
      <>
        <Header />
        <Loggedin session={session} />
        <Footer />
      </>
    );
  }
  return (
    <>
      <Header />
      <Loggedout />
      <Footer />
    </>
  );
}
