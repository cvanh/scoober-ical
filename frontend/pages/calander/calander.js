import { useSession } from "next-auth/react";

function Calander(props){
    const { data: session } = useSession();
    
    // TODO process the uid from the jwt correctly
    // const icalurl = `${process.env.BACKENDURL}/calander/${session.user.uid}` 
    const icalurl = `${process.env.BACKENDURL}/calander/USERFIXME` 
    return(
        <div>
            your ical link is: 
            <pre>{icalurl}</pre>
            <a href={`webcal://${icalurl}`}>zooi</a>
        </div>
    )
}

export default Calander;