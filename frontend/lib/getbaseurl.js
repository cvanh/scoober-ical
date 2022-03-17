function GetBaseUrl(){
    const BaseUrl = (process.env.NODE_ENV === "production" ? 
          "http://imaretarded.dev" : "http://localhost:3000");
    return BaseUrl;
}

export default GetBaseUrl;