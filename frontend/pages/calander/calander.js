import { useSession, signIn, signOut } from "next-auth/react";
import Link from "next/link";
import GetbackendUrl from "../../lib/getbackendurl";

function Calander(){
    const { data: session } = useSession();
    const icalurl = `${GetbackendUrl()}/calander/${session?.user?.name}`
    return(
        <div>
            <div className="button">
            <Link href="/">fuck go back</Link>
            </div>
            your ical link is: 
            <pre>{icalurl}</pre>
            <a href={icalurl}>Get your url here</a>
        </div>
    )
}

export default Calander;