function GetbackendUrl(){
    const BaseUrl = (process.env.NODE_ENV === "production" ? 
          "http://imaretarded.dev" : "http://localhost:8000");
    return BaseUrl;
}

export default GetbackendUrl;