# Authenticating endpoints


## Login.


Login to organization

> Example request:

```bash
curl -X POST \
    "http://localhost/api/client/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"consequuntur","password":"dolor","wallet":"quidem"}'

```

```javascript
const url = new URL(
    "http://localhost/api/client/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "consequuntur",
    "password": "dolor",
    "wallet": "quidem"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json

{
 "access_token": "access_token_here",
 "expires_at": "2022-12-02 23:01:04",
 "message": "Login successfully.",
 "success": true,
 "user": {
     "id": 17,
     "org_id": 1,
     "is_owner": 0,
     "email": "khaothi17@hungthinh.edu.vn",
     "full_name": "To Khao Thi VKU",
     …,
 },
 "created_at": "2021-12-02 18:23:04",
 "email": "khaothi17@hungthinh.edu.vn"
}
```
<div id="execution-results-POSTapi-client-auth-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-client-auth-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-client-auth-login"></code></pre>
</div>
<div id="execution-error-POSTapi-client-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-client-auth-login"></code></pre>
</div>
<form id="form-POSTapi-client-auth-login" data-method="POST" data-path="api/client/auth/login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-client-auth-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-client-auth-login" onclick="tryItOut('POSTapi-client-auth-login');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-client-auth-login" onclick="cancelTryOut('POSTapi-client-auth-login');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-client-auth-login" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/client/auth/login</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>String</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-client-auth-login" data-component="body" required  hidden>
<br>

</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>String</small>  &nbsp;
<input type="password" name="password" data-endpoint="POSTapi-client-auth-login" data-component="body" required  hidden>
<br>

</p>
<p>
<b><code>wallet</code></b>&nbsp;&nbsp;<small>String</small>  &nbsp;
<input type="text" name="wallet" data-endpoint="POSTapi-client-auth-login" data-component="body" required  hidden>
<br>
<h4 class="fancy-heading-panel"><b>Success Code</b></h4>
<p> 0 => success</p>
<h4 class="fancy-heading-panel"><b>Error Code</b></h4>
<p><b><code>1</code></b>  <small>Wallet credentials is not valid.</small>
<p><b><code>2</code></b>  <small> Username or password are wrong.</small>
</p>

</form>


## Register.


Login to organization (Only admin of organization can execute this endpoint)

> Example request:

```bash
curl -X POST \
    "http://localhost/api/client/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"org_id":"quas","email":"voluptatum","full_name":"eum","password":"excepturi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/client/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "org_id": "quas",
    "email": "voluptatum",
    "full_name": "eum",
    "password": "excepturi"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (201):

```json
{
    "message": "Register successfully.",
    "success": true,
    "user": {
        "org_id": 1,
        "email": "khaothi17@hungthinh.edu.vn",
        "full_name": "To Khao Thi VKU",
        "updated_at": "2021-12-02 18:23:04",
        "created_at": "2021-12-02 18:23:04",
        "id": 17
    },
    "wallet": "eyJpdiI6Ik9ORFdhMnA1T0hJaUhQTnVGWGxMMmc9PSIsInZhbHVlIjoiMzQ"
}
```
<div id="execution-results-POSTapi-client-auth-register" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-client-auth-register"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-client-auth-register"></code></pre>
</div>
<div id="execution-error-POSTapi-client-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-client-auth-register"></code></pre>
</div>
<form id="form-POSTapi-client-auth-register" data-method="POST" data-path="api/client/auth/register" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-client-auth-register', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-client-auth-register" onclick="tryItOut('POSTapi-client-auth-register');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-client-auth-register" onclick="cancelTryOut('POSTapi-client-auth-register');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-client-auth-register" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/client/auth/register</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>org_id</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
<input type="text" name="org_id" data-endpoint="POSTapi-client-auth-register" data-component="body" required  hidden>
<br>

</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>String</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-client-auth-register" data-component="body" required  hidden>
<br>

</p>
<p>
<b><code>full_name</code></b>&nbsp;&nbsp;<small>String</small>  &nbsp;
<input type="text" name="full_name" data-endpoint="POSTapi-client-auth-register" data-component="body" required  hidden>
<br>

</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>String</small>  &nbsp;
<input type="password" name="password" data-endpoint="POSTapi-client-auth-register" data-component="body" required  hidden>
<br>

</p>

</form>



