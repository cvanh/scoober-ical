import NextAuth from "next-auth";
import Scoober from "../../../src/scooberprovider";
import GoogleProvider from "next-auth/providers/google";
import EmailProvider from "next-auth/providers/email";
import CredentialsProvider from "next-auth/providers/credentials";

export default NextAuth({
  secret: process.env.SECRET,
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        username: {
          label: "gebruikersnaam",
          type: "text",
          placeholder: "koos tasloos",
        },
        password: { label: "wachtwoord", type: "password" },
      },

      // handle the login logic
      async authorize(credentials, req) {
        let userdata = {};
        // ask the backend to login to scoober
        await fetch("http://localhost:8000/login", {
          method: "POST",
          body: JSON.stringify({
            email: credentials.username,
            password: credentials.password,
          }),
          headers: {
            "Content-type": "application/json; charset=UTF-8",
          },
        })
          .then(response => response.json())
          .then(data => {
            console.log(data.uid)
            userdata.uid = data.uid
            userdata.email = data.email
          });
          console.log(userdata);

        return userdata;
      },
    }),
  ],
});
