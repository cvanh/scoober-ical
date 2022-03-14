import { useSession, signIn, signOut } from "next-auth/react"

function Calander(props){
    const { data: session } = useSession();
    
    // TODO process the uid from the jwt correctly
    // console.log(session.user.name);
    const icalurl = 'http://localhost:3000/calander/' + ((session === undefined) ? "session.name" : session.name)
    // const icalurl = `${process.env.BACKENDURL}/calander/USERFIXME` 
    return(
        <div>
            your ical link is: 
            {/* <pre>{icalurl}</pre> */}
            {/* <a href={`webcal://${icalurl}`}>zooi</a> */}
        </div>
    )
}

Calander.getInitialProps = ({req, res}) => {

}

export default Calander;