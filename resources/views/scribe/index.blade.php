<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:1234";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.9.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.9.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-changerequest" class="tocify-header">
                <li class="tocify-item level-1" data-unique="changerequest">
                    <a href="#changerequest">ChangeRequest</a>
                </li>
                                    <ul id="tocify-subheader-changerequest" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="changerequest-GETapi-change-requests">
                                <a href="#changerequest-GETapi-change-requests">GET api/change-requests</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="changerequest-GETapi-change-requests-info-newly">
                                <a href="#changerequest-GETapi-change-requests-info-newly">GET api/change-requests/info/newly</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="changerequest-GETapi-change-requests-info-pending">
                                <a href="#changerequest-GETapi-change-requests-info-pending">GET api/change-requests/info/pending</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="changerequest-PUTapi-change-requests--changeRequest_id-">
                                <a href="#changerequest-PUTapi-change-requests--changeRequest_id-">PUT api/change-requests/{changeRequest_id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-employee" class="tocify-header">
                <li class="tocify-item level-1" data-unique="employee">
                    <a href="#employee">Employee</a>
                </li>
                                    <ul id="tocify-subheader-employee" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="employee-GETapi-employees">
                                <a href="#employee-GETapi-employees">GET api/employees</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="employee-GETapi-employees--employee_id-">
                                <a href="#employee-GETapi-employees--employee_id-">GET api/employees/{employee_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="employee-GETapi-employees-info-count">
                                <a href="#employee-GETapi-employees-info-count">GET api/employees/info/count</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="employee-POSTapi-employees">
                                <a href="#employee-POSTapi-employees">POST api/employees</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="employee-PUTapi-employees--employee_id-">
                                <a href="#employee-PUTapi-employees--employee_id-">PUT api/employees/{employee_id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-countries">
                                <a href="#endpoints-GETapi-countries">GET api/countries</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-provinces">
                                <a href="#endpoints-GETapi-provinces">GET api/provinces</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cities">
                                <a href="#endpoints-GETapi-cities">GET api/cities</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cities--provinceCode-">
                                <a href="#endpoints-GETapi-cities--provinceCode-">GET api/cities/{provinceCode}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-districts">
                                <a href="#endpoints-GETapi-districts">GET api/districts</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-districts--cityCode-">
                                <a href="#endpoints-GETapi-districts--cityCode-">GET api/districts/{cityCode}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-villages">
                                <a href="#endpoints-GETapi-villages">GET api/villages</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-villages--districtCode-">
                                <a href="#endpoints-GETapi-villages--districtCode-">GET api/villages/{districtCode}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 6, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:1234</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Kamu dapat mendapatkan JWT token dengan melakukan login pada service 1 atau craft sendiri JWT Tokennya</p>

        <h1 id="changerequest">ChangeRequest</h1>

    <p>Endpoint terkait operasi permintaan perubahan data pegawai tertentu SIMPADU.</p>

                                <h2 id="changerequest-GETapi-change-requests">GET api/change-requests</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-change-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/change-requests?page=16" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/change-requests"
);

const params = {
    "page": "16",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-change-requests">
            <blockquote>
            <p>Example response (200, Sukses mendapatkan data permintaan perubahan. Note:
                      Jika role admin akan menampilkan semua data, 
                      Jika role dosen hanya menampilkan data miliknya sendiri):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;019df6c9-badf-734e-91ad-e51cd9649cf0&quot;,
            &quot;field_name&quot;: &quot;nik&quot;,
            &quot;old_value&quot;: &quot;8106080403076841&quot;,
            &quot;new_value&quot;: &quot;1952765217638904&quot;,
            &quot;status&quot;: &quot;rejected&quot;,
            &quot;employee_id&quot;: &quot;019df6c9-9ff0-726b-b94a-a688f3321eb4&quot;,
            &quot;employee&quot;: {
                &quot;id&quot;: &quot;019df6c9-9ff0-726b-b94a-a688f3321eb4&quot;,
                &quot;nip&quot;: &quot;113885585713262403&quot;,
                &quot;nik&quot;: &quot;8106080403076841&quot;,
                &quot;employee_name&quot;: &quot;Warsita Uwais&quot;,
                &quot;address&quot;: &quot;Kpg. Untung Suropati No. 955, Pariaman 22832, DIY&quot;,
                &quot;birth_place&quot;: &quot;Kendari&quot;,
                &quot;birth_date&quot;: &quot;2006-03-20&quot;,
                &quot;gender&quot;: &quot;female&quot;,
                &quot;phone_number&quot;: &quot;085592483500&quot;,
                &quot;village_code&quot;: &quot;6402192001&quot;,
                &quot;district_code&quot;: &quot;640219&quot;,
                &quot;city_code&quot;: &quot;6402&quot;,
                &quot;province_code&quot;: &quot;64&quot;,
                &quot;citizen_code&quot;: &quot;64&quot;
            }
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 4,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:1234/api/change-requests&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 34
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-change-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-change-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-change-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-change-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-change-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-change-requests" data-method="GET"
      data-path="api/change-requests"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-change-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-change-requests"
                    onclick="tryItOut('GETapi-change-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-change-requests"
                    onclick="cancelTryOut('GETapi-change-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-change-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/change-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-change-requests"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-change-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-change-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-change-requests"
               value="16"
               data-component="query">
    <br>
<p>Nomor Halaman, required: false, Default: 1 Example: <code>16</code></p>
            </div>
                </form>

                    <h2 id="changerequest-GETapi-change-requests-info-newly">GET api/change-requests/info/newly</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-change-requests-info-newly">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/change-requests/info/newly" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/change-requests/info/newly"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-change-requests-info-newly">
            <blockquote>
            <p>Example response (200, Sukses mengubah data permintaan perubahan):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;019df6c9-badf-734e-91ad-e51cd9649cf0&quot;,
            &quot;field_name&quot;: &quot;nik&quot;,
            &quot;old_value&quot;: &quot;8106080403076841&quot;,
            &quot;new_value&quot;: &quot;1952765217638904&quot;,
            &quot;status&quot;: &quot;rejected&quot;,
            &quot;employee_id&quot;: &quot;019df6c9-9ff0-726b-b94a-a688f3321eb4&quot;,
            &quot;employee&quot;: {
                &quot;id&quot;: &quot;019df6c9-9ff0-726b-b94a-a688f3321eb4&quot;,
                &quot;nip&quot;: &quot;113885585713262403&quot;,
                &quot;nik&quot;: &quot;8106080403076841&quot;,
                &quot;employee_name&quot;: &quot;Warsita Uwais&quot;,
                &quot;address&quot;: &quot;Kpg. Untung Suropati No. 955, Pariaman 22832, DIY&quot;,
                &quot;birth_place&quot;: &quot;Kendari&quot;,
                &quot;birth_date&quot;: &quot;2006-03-20&quot;,
                &quot;gender&quot;: &quot;female&quot;,
                &quot;phone_number&quot;: &quot;085592483500&quot;,
                &quot;village_code&quot;: &quot;6402192001&quot;,
                &quot;district_code&quot;: &quot;640219&quot;,
                &quot;city_code&quot;: &quot;6402&quot;,
                &quot;province_code&quot;: &quot;64&quot;,
                &quot;citizen_code&quot;: &quot;64&quot;
            }
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 4,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/change-requests?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:1234/api/change-requests&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 34
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-change-requests-info-newly" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-change-requests-info-newly"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-change-requests-info-newly"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-change-requests-info-newly" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-change-requests-info-newly">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-change-requests-info-newly" data-method="GET"
      data-path="api/change-requests/info/newly"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-change-requests-info-newly', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-change-requests-info-newly"
                    onclick="tryItOut('GETapi-change-requests-info-newly');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-change-requests-info-newly"
                    onclick="cancelTryOut('GETapi-change-requests-info-newly');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-change-requests-info-newly"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/change-requests/info/newly</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-change-requests-info-newly"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-change-requests-info-newly"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-change-requests-info-newly"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="changerequest-GETapi-change-requests-info-pending">GET api/change-requests/info/pending</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-change-requests-info-pending">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/change-requests/info/pending" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/change-requests/info/pending"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-change-requests-info-pending">
            <blockquote>
            <p>Example response (200, Sukses mendapatkan total data pegawai):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: {
        &quot;total_pending&quot;: 14
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-change-requests-info-pending" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-change-requests-info-pending"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-change-requests-info-pending"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-change-requests-info-pending" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-change-requests-info-pending">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-change-requests-info-pending" data-method="GET"
      data-path="api/change-requests/info/pending"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-change-requests-info-pending', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-change-requests-info-pending"
                    onclick="tryItOut('GETapi-change-requests-info-pending');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-change-requests-info-pending"
                    onclick="cancelTryOut('GETapi-change-requests-info-pending');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-change-requests-info-pending"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/change-requests/info/pending</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-change-requests-info-pending"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-change-requests-info-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-change-requests-info-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="changerequest-PUTapi-change-requests--changeRequest_id-">PUT api/change-requests/{changeRequest_id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-change-requests--changeRequest_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:1234/api/change-requests/019df6c9-aafe-728b-9054-210f086ead95" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"header_content_type\": \"application\\/json\",
    \"status\": \"rejected\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/change-requests/019df6c9-aafe-728b-9054-210f086ead95"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "header_content_type": "application\/json",
    "status": "rejected"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-change-requests--changeRequest_id-">
            <blockquote>
            <p>Example response (200, Sukses mengubah data permintaan perubahan):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data updated successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: {
        &quot;id&quot;: &quot;019df6c9-acd7-736a-883a-13863afd302c&quot;,
        &quot;field_name&quot;: &quot;employee_name&quot;,
        &quot;old_value&quot;: &quot;Mahdi Harjasa Mahendra M.Ak&quot;,
        &quot;new_value&quot;: &quot;Diah Eka Mulyani S.H.&quot;,
        &quot;status&quot;: &quot;approved&quot;,
        &quot;employee_id&quot;: &quot;019df6c9-8f63-70c8-97d4-8f03a63be8d5&quot;,
        &quot;employee&quot;: {
            &quot;id&quot;: &quot;019df6c9-8f63-70c8-97d4-8f03a63be8d5&quot;,
            &quot;nip&quot;: &quot;691651594659009703&quot;,
            &quot;nik&quot;: &quot;1801160204072477&quot;,
            &quot;employee_name&quot;: &quot;Diah Eka Mulyani S.H.&quot;,
            &quot;address&quot;: &quot;Gg. Casablanca No. 249, Administrasi Jakarta Timur 83230, Sulteng&quot;,
            &quot;birth_place&quot;: &quot;Sungai Penuh&quot;,
            &quot;birth_date&quot;: &quot;2003-12-31&quot;,
            &quot;gender&quot;: &quot;male&quot;,
            &quot;phone_number&quot;: &quot;087480210541&quot;,
            &quot;village_code&quot;: &quot;9403152001&quot;,
            &quot;district_code&quot;: &quot;940315&quot;,
            &quot;city_code&quot;: &quot;9403&quot;,
            &quot;province_code&quot;: &quot;94&quot;,
            &quot;citizen_code&quot;: &quot;94&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-change-requests--changeRequest_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-change-requests--changeRequest_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-change-requests--changeRequest_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-change-requests--changeRequest_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-change-requests--changeRequest_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-change-requests--changeRequest_id-" data-method="PUT"
      data-path="api/change-requests/{changeRequest_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-change-requests--changeRequest_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-change-requests--changeRequest_id-"
                    onclick="tryItOut('PUTapi-change-requests--changeRequest_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-change-requests--changeRequest_id-"
                    onclick="cancelTryOut('PUTapi-change-requests--changeRequest_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-change-requests--changeRequest_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/change-requests/{changeRequest_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>changeRequest_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="changeRequest_id"                data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="019df6c9-aafe-728b-9054-210f086ead95"
               data-component="url">
    <br>
<p>The ID of the changeRequest. Example: <code>019df6c9-aafe-728b-9054-210f086ead95</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>change-request</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="change-request"                data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="123e4567-e89b-12d3-a456-426614174000"
               data-component="url">
    <br>
<p>UUID Permintaan Perubahan Example: <code>123e4567-e89b-12d3-a456-426614174000</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>header_content_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="header_content_type"                data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="application/json"
               data-component="body">
    <br>
<p>Example: <code>application/json</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>application/json</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-change-requests--changeRequest_id-"
               value="rejected"
               data-component="body">
    <br>
<p>Example: <code>rejected</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>pending</code></li> <li><code>approved</code></li> <li><code>rejected</code></li></ul>
        </div>
        </form>

                <h1 id="employee">Employee</h1>

    <p>Endpoint terkait operasi data pegawai SIMPADU.</p>

                                <h2 id="employee-GETapi-employees">GET api/employees</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-employees">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/employees?page=16" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/employees"
);

const params = {
    "page": "16",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-employees">
            <blockquote>
            <p>Example response (200, Sukses mendapatkan data pegawai):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;019df6c9-97bb-7295-a954-884fdfaec6e9&quot;,
            &quot;nip&quot;: &quot;350661066055483856&quot;,
            &quot;nik&quot;: &quot;7406980408239916&quot;,
            &quot;employee_name&quot;: &quot;Salimah Zulaika&quot;,
            &quot;address&quot;: &quot;Jln. Elang No. 856, Sabang 82360, Papua&quot;,
            &quot;birth_place&quot;: &quot;Batam&quot;,
            &quot;birth_date&quot;: &quot;2000-07-02&quot;,
            &quot;gender&quot;: &quot;female&quot;,
            &quot;phone_number&quot;: &quot;084331744670&quot;,
            &quot;village_code&quot;: &quot;7409082013&quot;,
            &quot;district_code&quot;: &quot;740908&quot;,
            &quot;city_code&quot;: &quot;7409&quot;,
            &quot;province_code&quot;: &quot;74&quot;,
            &quot;citizen_code&quot;: &quot;74&quot;,
            &quot;village&quot;: {
                &quot;id&quot;: &quot;71884&quot;,
                &quot;code&quot;: &quot;7409082013&quot;,
                &quot;district_code&quot;: &quot;740908&quot;,
                &quot;name&quot;: &quot;LAMEORU&quot;
            },
            &quot;district&quot;: {
                &quot;id&quot;: &quot;6035&quot;,
                &quot;code&quot;: &quot;740908&quot;,
                &quot;city_code&quot;: &quot;7409&quot;,
                &quot;name&quot;: &quot;OHEO&quot;
            },
            &quot;city&quot;: {
                &quot;id&quot;: &quot;431&quot;,
                &quot;code&quot;: &quot;7409&quot;,
                &quot;name&quot;: &quot;KABUPATEN KONAWE UTARA&quot;
            },
            &quot;province&quot;: {
                &quot;id&quot;: &quot;28&quot;,
                &quot;code&quot;: &quot;74&quot;,
                &quot;name&quot;: &quot;SULAWESI TENGGARA&quot;
            },
            &quot;citizen&quot;: {
                &quot;id&quot;: 37,
                &quot;name&quot;: &quot;Bhutan&quot;,
                &quot;code&quot;: &quot;BT&quot;
            }
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 3,
        &quot;from&quot;: 21,
        &quot;last_page&quot;: 6,
        &quot;links&quot;: [
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=2&quot;,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://127.0.0.1:1234/api/employees?page=4&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://127.0.0.1:1234/api/employees&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 30,
        &quot;total&quot;: 54
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-employees" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-employees"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-employees"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-employees" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-employees">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-employees" data-method="GET"
      data-path="api/employees"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-employees', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-employees"
                    onclick="tryItOut('GETapi-employees');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-employees"
                    onclick="cancelTryOut('GETapi-employees');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-employees"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/employees</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-employees"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-employees"
               value="16"
               data-component="query">
    <br>
<p>Nomor Halaman, required: false, Default: 1 Example: <code>16</code></p>
            </div>
                </form>

                    <h2 id="employee-GETapi-employees--employee_id-">GET api/employees/{employee_id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-employees--employee_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/employees/019df6c9-8f19-73d7-b9db-a0d11acce3bb" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/employees/019df6c9-8f19-73d7-b9db-a0d11acce3bb"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-employees--employee_id-">
            <blockquote>
            <p>Example response (200, Sukses mendapatkan detail pegawai):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: {
        &quot;id&quot;: &quot;019df6c9-97bb-7295-a954-884fdfaec6e9&quot;,
        &quot;nip&quot;: &quot;350661066055483856&quot;,
        &quot;nik&quot;: &quot;7406980408239916&quot;,
        &quot;employee_name&quot;: &quot;Salimah Zulaika&quot;,
        &quot;address&quot;: &quot;Jln. Elang No. 856, Sabang 82360, Papua&quot;,
        &quot;birth_place&quot;: &quot;Batam&quot;,
        &quot;birth_date&quot;: &quot;2000-07-02&quot;,
        &quot;gender&quot;: &quot;female&quot;,
        &quot;phone_number&quot;: &quot;084331744670&quot;,
        &quot;village_code&quot;: &quot;7409082013&quot;,
        &quot;district_code&quot;: &quot;740908&quot;,
        &quot;city_code&quot;: &quot;7409&quot;,
        &quot;province_code&quot;: &quot;74&quot;,
        &quot;citizen_code&quot;: &quot;74&quot;,
        &quot;village&quot;: {
            &quot;id&quot;: &quot;71884&quot;,
            &quot;code&quot;: &quot;7409082013&quot;,
            &quot;district_code&quot;: &quot;740908&quot;,
            &quot;name&quot;: &quot;LAMEORU&quot;
        },
        &quot;district&quot;: {
            &quot;id&quot;: &quot;6035&quot;,
            &quot;code&quot;: &quot;740908&quot;,
            &quot;city_code&quot;: &quot;7409&quot;,
            &quot;name&quot;: &quot;OHEO&quot;
        },
        &quot;city&quot;: {
            &quot;id&quot;: &quot;431&quot;,
            &quot;code&quot;: &quot;7409&quot;,
            &quot;name&quot;: &quot;KABUPATEN KONAWE UTARA&quot;
        },
        &quot;province&quot;: {
            &quot;id&quot;: &quot;28&quot;,
            &quot;code&quot;: &quot;74&quot;,
            &quot;name&quot;: &quot;SULAWESI TENGGARA&quot;
        },
        &quot;citizen&quot;: {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Bhutan&quot;,
            &quot;code&quot;: &quot;BT&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Data tidak ditemukan):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 404,
    &quot;message&quot;: &quot;Resource not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-employees--employee_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-employees--employee_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-employees--employee_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-employees--employee_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-employees--employee_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-employees--employee_id-" data-method="GET"
      data-path="api/employees/{employee_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-employees--employee_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-employees--employee_id-"
                    onclick="tryItOut('GETapi-employees--employee_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-employees--employee_id-"
                    onclick="cancelTryOut('GETapi-employees--employee_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-employees--employee_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/employees/{employee_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-employees--employee_id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-employees--employee_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-employees--employee_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>employee_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="employee_id"                data-endpoint="GETapi-employees--employee_id-"
               value="019df6c9-8f19-73d7-b9db-a0d11acce3bb"
               data-component="url">
    <br>
<p>The ID of the employee. Example: <code>019df6c9-8f19-73d7-b9db-a0d11acce3bb</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>employee</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="employee"                data-endpoint="GETapi-employees--employee_id-"
               value="123e4567-e89b-12d3-a456-426614174000"
               data-component="url">
    <br>
<p>UUID Pegawai Example: <code>123e4567-e89b-12d3-a456-426614174000</code></p>
            </div>
                    </form>

                    <h2 id="employee-GETapi-employees-info-count">GET api/employees/info/count</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-employees-info-count">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/employees/info/count" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/employees/info/count"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-employees-info-count">
            <blockquote>
            <p>Example response (200, Sukses mendapatkan total data pegawai):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: {
        &quot;total_employee&quot;: 54
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-employees-info-count" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-employees-info-count"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-employees-info-count"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-employees-info-count" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-employees-info-count">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-employees-info-count" data-method="GET"
      data-path="api/employees/info/count"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-employees-info-count', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-employees-info-count"
                    onclick="tryItOut('GETapi-employees-info-count');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-employees-info-count"
                    onclick="cancelTryOut('GETapi-employees-info-count');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-employees-info-count"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/employees/info/count</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-employees-info-count"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-employees-info-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-employees-info-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="employee-POSTapi-employees">POST api/employees</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-employees">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:1234/api/employees" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"header_content_type\": \"application\\/json\",
    \"nip\": \"bngzmiyvdljnikhway\",
    \"nik\": \"kcmyuwpwlvqwrsit\",
    \"employee_name\": \"c\",
    \"address\": \"p\",
    \"birth_place\": \"s\",
    \"birth_date\": \"2026-05-06\",
    \"gender\": \"female\",
    \"phone_number\": \"c\",
    \"village_code\": \"qldzsnrwtu\",
    \"district_code\": \"jwvlxj\",
    \"city_code\": \"klqp\",
    \"province_code\": \"pw\",
    \"citizen_code\": \"qb\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/employees"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "header_content_type": "application\/json",
    "nip": "bngzmiyvdljnikhway",
    "nik": "kcmyuwpwlvqwrsit",
    "employee_name": "c",
    "address": "p",
    "birth_place": "s",
    "birth_date": "2026-05-06",
    "gender": "female",
    "phone_number": "c",
    "village_code": "qldzsnrwtu",
    "district_code": "jwvlxj",
    "city_code": "klqp",
    "province_code": "pw",
    "citizen_code": "qb"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-employees">
            <blockquote>
            <p>Example response (201, Sukses menambahkan data pegawai):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: {
        &quot;id&quot;: &quot;019df6c9-97bb-7295-a954-884fdfaec6e9&quot;,
        &quot;nip&quot;: &quot;350661066055483856&quot;,
        &quot;nik&quot;: &quot;7406980408239916&quot;,
        &quot;employee_name&quot;: &quot;Salimah Zulaika&quot;,
        &quot;address&quot;: &quot;Jln. Elang No. 856, Sabang 82360, Papua&quot;,
        &quot;birth_place&quot;: &quot;Batam&quot;,
        &quot;birth_date&quot;: &quot;2000-07-02&quot;,
        &quot;gender&quot;: &quot;female&quot;,
        &quot;phone_number&quot;: &quot;084331744670&quot;,
        &quot;village_code&quot;: &quot;7409082013&quot;,
        &quot;district_code&quot;: &quot;740908&quot;,
        &quot;city_code&quot;: &quot;7409&quot;,
        &quot;province_code&quot;: &quot;74&quot;,
        &quot;citizen_code&quot;: &quot;74&quot;,
        &quot;village&quot;: {
            &quot;id&quot;: &quot;71884&quot;,
            &quot;code&quot;: &quot;7409082013&quot;,
            &quot;district_code&quot;: &quot;740908&quot;,
            &quot;name&quot;: &quot;LAMEORU&quot;
        },
        &quot;district&quot;: {
            &quot;id&quot;: &quot;6035&quot;,
            &quot;code&quot;: &quot;740908&quot;,
            &quot;city_code&quot;: &quot;7409&quot;,
            &quot;name&quot;: &quot;OHEO&quot;
        },
        &quot;city&quot;: {
            &quot;id&quot;: &quot;431&quot;,
            &quot;code&quot;: &quot;7409&quot;,
            &quot;name&quot;: &quot;KABUPATEN KONAWE UTARA&quot;
        },
        &quot;province&quot;: {
            &quot;id&quot;: &quot;28&quot;,
            &quot;code&quot;: &quot;74&quot;,
            &quot;name&quot;: &quot;SULAWESI TENGGARA&quot;
        },
        &quot;citizen&quot;: {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Bhutan&quot;,
            &quot;code&quot;: &quot;BT&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-employees" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-employees"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-employees"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-employees" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-employees">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-employees" data-method="POST"
      data-path="api/employees"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-employees', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-employees"
                    onclick="tryItOut('POSTapi-employees');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-employees"
                    onclick="cancelTryOut('POSTapi-employees');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-employees"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/employees</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-employees"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-employees"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>header_content_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="header_content_type"                data-endpoint="POSTapi-employees"
               value="application/json"
               data-component="body">
    <br>
<p>Example: <code>application/json</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>application/json</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nip</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nip"                data-endpoint="POSTapi-employees"
               value="bngzmiyvdljnikhway"
               data-component="body">
    <br>
<p>Must be 18 characters. Example: <code>bngzmiyvdljnikhway</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nik</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nik"                data-endpoint="POSTapi-employees"
               value="kcmyuwpwlvqwrsit"
               data-component="body">
    <br>
<p>Must be 16 characters. Example: <code>kcmyuwpwlvqwrsit</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>employee_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="employee_name"                data-endpoint="POSTapi-employees"
               value="c"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="POSTapi-employees"
               value="p"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>p</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_place</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_place"                data-endpoint="POSTapi-employees"
               value="s"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>s</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="POSTapi-employees"
               value="2026-05-06"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-05-06</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-employees"
               value="female"
               data-component="body">
    <br>
<p>Example: <code>female</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-employees"
               value="c"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 15 characters. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>village_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="village_code"                data-endpoint="POSTapi-employees"
               value="qldzsnrwtu"
               data-component="body">
    <br>
<p>Must be 10 characters. Example: <code>qldzsnrwtu</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>district_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="district_code"                data-endpoint="POSTapi-employees"
               value="jwvlxj"
               data-component="body">
    <br>
<p>Must be 6 characters. Example: <code>jwvlxj</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city_code"                data-endpoint="POSTapi-employees"
               value="klqp"
               data-component="body">
    <br>
<p>Must be 4 characters. Example: <code>klqp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>province_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="province_code"                data-endpoint="POSTapi-employees"
               value="pw"
               data-component="body">
    <br>
<p>Must be 2 characters. Example: <code>pw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>citizen_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="citizen_code"                data-endpoint="POSTapi-employees"
               value="qb"
               data-component="body">
    <br>
<p>Must be 2 characters. Example: <code>qb</code></p>
        </div>
        </form>

                    <h2 id="employee-PUTapi-employees--employee_id-">PUT api/employees/{employee_id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-employees--employee_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:1234/api/employees/019df6c9-8f19-73d7-b9db-a0d11acce3bb" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"header_content_type\": \"application\\/json\",
    \"nip\": \"bngzmiyvdljnikhway\",
    \"nik\": \"kcmyuwpwlvqwrsit\",
    \"employee_name\": \"c\",
    \"address\": \"p\",
    \"birth_place\": \"s\",
    \"birth_date\": \"2026-05-06\",
    \"gender\": \"female\",
    \"phone_number\": \"c\",
    \"village_code\": \"qldzsnrwtu\",
    \"district_code\": \"jwvlxj\",
    \"city_code\": \"klqp\",
    \"province_code\": \"pw\",
    \"citizen_code\": \"qb\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/employees/019df6c9-8f19-73d7-b9db-a0d11acce3bb"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "header_content_type": "application\/json",
    "nip": "bngzmiyvdljnikhway",
    "nik": "kcmyuwpwlvqwrsit",
    "employee_name": "c",
    "address": "p",
    "birth_place": "s",
    "birth_date": "2026-05-06",
    "gender": "female",
    "phone_number": "c",
    "village_code": "qldzsnrwtu",
    "district_code": "jwvlxj",
    "city_code": "klqp",
    "province_code": "pw",
    "citizen_code": "qb"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-employees--employee_id-">
            <blockquote>
            <p>Example response (200, Sukses mengubah data pegawai):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Data retrieved successfully&quot;,
    &quot;code&quot;: 200,
    &quot;data&quot;: {
        &quot;id&quot;: &quot;019df6c9-97bb-7295-a954-884fdfaec6e9&quot;,
        &quot;nip&quot;: &quot;350661066055483856&quot;,
        &quot;nik&quot;: &quot;7406980408239916&quot;,
        &quot;employee_name&quot;: &quot;Salimah Zulaika&quot;,
        &quot;address&quot;: &quot;Jln. Elang No. 856, Sabang 82360, Papua&quot;,
        &quot;birth_place&quot;: &quot;Batam&quot;,
        &quot;birth_date&quot;: &quot;2000-07-02&quot;,
        &quot;gender&quot;: &quot;female&quot;,
        &quot;phone_number&quot;: &quot;084331744670&quot;,
        &quot;village_code&quot;: &quot;7409082013&quot;,
        &quot;district_code&quot;: &quot;740908&quot;,
        &quot;city_code&quot;: &quot;7409&quot;,
        &quot;province_code&quot;: &quot;74&quot;,
        &quot;citizen_code&quot;: &quot;74&quot;,
        &quot;village&quot;: {
            &quot;id&quot;: &quot;71884&quot;,
            &quot;code&quot;: &quot;7409082013&quot;,
            &quot;district_code&quot;: &quot;740908&quot;,
            &quot;name&quot;: &quot;LAMEORU&quot;
        },
        &quot;district&quot;: {
            &quot;id&quot;: &quot;6035&quot;,
            &quot;code&quot;: &quot;740908&quot;,
            &quot;city_code&quot;: &quot;7409&quot;,
            &quot;name&quot;: &quot;OHEO&quot;
        },
        &quot;city&quot;: {
            &quot;id&quot;: &quot;431&quot;,
            &quot;code&quot;: &quot;7409&quot;,
            &quot;name&quot;: &quot;KABUPATEN KONAWE UTARA&quot;
        },
        &quot;province&quot;: {
            &quot;id&quot;: &quot;28&quot;,
            &quot;code&quot;: &quot;74&quot;,
            &quot;name&quot;: &quot;SULAWESI TENGGARA&quot;
        },
        &quot;citizen&quot;: {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Bhutan&quot;,
            &quot;code&quot;: &quot;BT&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Tidak terotentikasi):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 401,
    &quot;message&quot;: &quot;You are not logged in&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Tidak memiliki izin):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 403,
    &quot;message&quot;: &quot;Forbidden&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Data tidak ditemukan):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;code&quot;: 404,
    &quot;message&quot;: &quot;Resource not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-employees--employee_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-employees--employee_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-employees--employee_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-employees--employee_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-employees--employee_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-employees--employee_id-" data-method="PUT"
      data-path="api/employees/{employee_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-employees--employee_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-employees--employee_id-"
                    onclick="tryItOut('PUTapi-employees--employee_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-employees--employee_id-"
                    onclick="cancelTryOut('PUTapi-employees--employee_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-employees--employee_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/employees/{employee_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-employees--employee_id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-employees--employee_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-employees--employee_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>employee_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="employee_id"                data-endpoint="PUTapi-employees--employee_id-"
               value="019df6c9-8f19-73d7-b9db-a0d11acce3bb"
               data-component="url">
    <br>
<p>The ID of the employee. Example: <code>019df6c9-8f19-73d7-b9db-a0d11acce3bb</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>employee</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="employee"                data-endpoint="PUTapi-employees--employee_id-"
               value="123e4567-e89b-12d3-a456-426614174000"
               data-component="url">
    <br>
<p>UUID Pegawai Example: <code>123e4567-e89b-12d3-a456-426614174000</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>header_content_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="header_content_type"                data-endpoint="PUTapi-employees--employee_id-"
               value="application/json"
               data-component="body">
    <br>
<p>Example: <code>application/json</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>application/json</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nip</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nip"                data-endpoint="PUTapi-employees--employee_id-"
               value="bngzmiyvdljnikhway"
               data-component="body">
    <br>
<p>Must be 18 characters. Example: <code>bngzmiyvdljnikhway</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nik</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nik"                data-endpoint="PUTapi-employees--employee_id-"
               value="kcmyuwpwlvqwrsit"
               data-component="body">
    <br>
<p>Must be 16 characters. Example: <code>kcmyuwpwlvqwrsit</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>employee_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="employee_name"                data-endpoint="PUTapi-employees--employee_id-"
               value="c"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address"                data-endpoint="PUTapi-employees--employee_id-"
               value="p"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>p</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_place</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_place"                data-endpoint="PUTapi-employees--employee_id-"
               value="s"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>s</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="PUTapi-employees--employee_id-"
               value="2026-05-06"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-05-06</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="PUTapi-employees--employee_id-"
               value="female"
               data-component="body">
    <br>
<p>Example: <code>female</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="PUTapi-employees--employee_id-"
               value="c"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 15 characters. Example: <code>c</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>village_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="village_code"                data-endpoint="PUTapi-employees--employee_id-"
               value="qldzsnrwtu"
               data-component="body">
    <br>
<p>Must be 10 characters. Example: <code>qldzsnrwtu</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>district_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="district_code"                data-endpoint="PUTapi-employees--employee_id-"
               value="jwvlxj"
               data-component="body">
    <br>
<p>Must be 6 characters. Example: <code>jwvlxj</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city_code"                data-endpoint="PUTapi-employees--employee_id-"
               value="klqp"
               data-component="body">
    <br>
<p>Must be 4 characters. Example: <code>klqp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>province_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="province_code"                data-endpoint="PUTapi-employees--employee_id-"
               value="pw"
               data-component="body">
    <br>
<p>Must be 2 characters. Example: <code>pw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>citizen_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="citizen_code"                data-endpoint="PUTapi-employees--employee_id-"
               value="qb"
               data-component="body">
    <br>
<p>Must be 2 characters. Example: <code>qb</code></p>
        </div>
        </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-countries">GET api/countries</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-countries">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/countries" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/countries"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-countries">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-countries" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-countries"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-countries"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-countries" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-countries">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-countries" data-method="GET"
      data-path="api/countries"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-countries', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-countries"
                    onclick="tryItOut('GETapi-countries');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-countries"
                    onclick="cancelTryOut('GETapi-countries');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-countries"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/countries</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-countries"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-countries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-countries"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-provinces">GET api/provinces</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-provinces">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/provinces" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/provinces"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-provinces">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;1&quot;,
            &quot;code&quot;: &quot;11&quot;,
            &quot;name&quot;: &quot;ACEH&quot;
        },
        {
            &quot;id&quot;: &quot;2&quot;,
            &quot;code&quot;: &quot;12&quot;,
            &quot;name&quot;: &quot;SUMATERA UTARA&quot;
        },
        {
            &quot;id&quot;: &quot;3&quot;,
            &quot;code&quot;: &quot;13&quot;,
            &quot;name&quot;: &quot;SUMATERA BARAT&quot;
        },
        {
            &quot;id&quot;: &quot;4&quot;,
            &quot;code&quot;: &quot;14&quot;,
            &quot;name&quot;: &quot;RIAU&quot;
        },
        {
            &quot;id&quot;: &quot;5&quot;,
            &quot;code&quot;: &quot;15&quot;,
            &quot;name&quot;: &quot;JAMBI&quot;
        },
        {
            &quot;id&quot;: &quot;6&quot;,
            &quot;code&quot;: &quot;16&quot;,
            &quot;name&quot;: &quot;SUMATERA SELATAN&quot;
        },
        {
            &quot;id&quot;: &quot;7&quot;,
            &quot;code&quot;: &quot;17&quot;,
            &quot;name&quot;: &quot;BENGKULU&quot;
        },
        {
            &quot;id&quot;: &quot;8&quot;,
            &quot;code&quot;: &quot;18&quot;,
            &quot;name&quot;: &quot;LAMPUNG&quot;
        },
        {
            &quot;id&quot;: &quot;9&quot;,
            &quot;code&quot;: &quot;19&quot;,
            &quot;name&quot;: &quot;KEPULAUAN BANGKA BELITUNG&quot;
        },
        {
            &quot;id&quot;: &quot;10&quot;,
            &quot;code&quot;: &quot;21&quot;,
            &quot;name&quot;: &quot;KEPULAUAN RIAU&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:1234/api/provinces?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:1234/api/provinces?page=4&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:1234/api/provinces?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 4,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/provinces?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/provinces?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/provinces?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/provinces?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/provinces?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:1234/api/provinces&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 38
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-provinces" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-provinces"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-provinces"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-provinces" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-provinces">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-provinces" data-method="GET"
      data-path="api/provinces"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-provinces', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-provinces"
                    onclick="tryItOut('GETapi-provinces');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-provinces"
                    onclick="cancelTryOut('GETapi-provinces');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-provinces"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/provinces</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-provinces"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-provinces"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-provinces"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-cities">GET api/cities</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/cities" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/cities"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cities">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;1&quot;,
            &quot;code&quot;: &quot;1101&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH SELATAN&quot;
        },
        {
            &quot;id&quot;: &quot;2&quot;,
            &quot;code&quot;: &quot;1102&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH TENGGARA&quot;
        },
        {
            &quot;id&quot;: &quot;3&quot;,
            &quot;code&quot;: &quot;1103&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH TIMUR&quot;
        },
        {
            &quot;id&quot;: &quot;4&quot;,
            &quot;code&quot;: &quot;1104&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH TENGAH&quot;
        },
        {
            &quot;id&quot;: &quot;5&quot;,
            &quot;code&quot;: &quot;1105&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH BARAT&quot;
        },
        {
            &quot;id&quot;: &quot;6&quot;,
            &quot;code&quot;: &quot;1106&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH BESAR&quot;
        },
        {
            &quot;id&quot;: &quot;7&quot;,
            &quot;code&quot;: &quot;1107&quot;,
            &quot;name&quot;: &quot;KABUPATEN PIDIE&quot;
        },
        {
            &quot;id&quot;: &quot;8&quot;,
            &quot;code&quot;: &quot;1108&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH UTARA&quot;
        },
        {
            &quot;id&quot;: &quot;9&quot;,
            &quot;code&quot;: &quot;1109&quot;,
            &quot;name&quot;: &quot;KABUPATEN SIMEULUE&quot;
        },
        {
            &quot;id&quot;: &quot;10&quot;,
            &quot;code&quot;: &quot;1110&quot;,
            &quot;name&quot;: &quot;KABUPATEN ACEH SINGKIL&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:1234/api/cities?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:1234/api/cities?page=52&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:1234/api/cities?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 52,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=10&quot;,
                &quot;label&quot;: &quot;10&quot;,
                &quot;page&quot;: 10,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;...&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=51&quot;,
                &quot;label&quot;: &quot;51&quot;,
                &quot;page&quot;: 51,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=52&quot;,
                &quot;label&quot;: &quot;52&quot;,
                &quot;page&quot;: 52,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/cities?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:1234/api/cities&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 514
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cities" data-method="GET"
      data-path="api/cities"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cities"
                    onclick="tryItOut('GETapi-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cities"
                    onclick="cancelTryOut('GETapi-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-cities"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-cities--provinceCode-">GET api/cities/{provinceCode}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-cities--provinceCode-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/cities/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/cities/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cities--provinceCode-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cities--provinceCode-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cities--provinceCode-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cities--provinceCode-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cities--provinceCode-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cities--provinceCode-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cities--provinceCode-" data-method="GET"
      data-path="api/cities/{provinceCode}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cities--provinceCode-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cities--provinceCode-"
                    onclick="tryItOut('GETapi-cities--provinceCode-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cities--provinceCode-"
                    onclick="cancelTryOut('GETapi-cities--provinceCode-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cities--provinceCode-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cities/{provinceCode}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-cities--provinceCode-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cities--provinceCode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cities--provinceCode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>provinceCode</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="provinceCode"                data-endpoint="GETapi-cities--provinceCode-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-districts">GET api/districts</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-districts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/districts" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/districts"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-districts">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;1&quot;,
            &quot;code&quot;: &quot;110101&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;BAKONGAN&quot;
        },
        {
            &quot;id&quot;: &quot;2&quot;,
            &quot;code&quot;: &quot;110102&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;KLUET UTARA&quot;
        },
        {
            &quot;id&quot;: &quot;3&quot;,
            &quot;code&quot;: &quot;110103&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;KLUET SELATAN&quot;
        },
        {
            &quot;id&quot;: &quot;4&quot;,
            &quot;code&quot;: &quot;110104&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;LABUHANHAJI&quot;
        },
        {
            &quot;id&quot;: &quot;5&quot;,
            &quot;code&quot;: &quot;110105&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;MEUKEK&quot;
        },
        {
            &quot;id&quot;: &quot;6&quot;,
            &quot;code&quot;: &quot;110106&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;SAMADUA&quot;
        },
        {
            &quot;id&quot;: &quot;7&quot;,
            &quot;code&quot;: &quot;110107&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;SAWANG&quot;
        },
        {
            &quot;id&quot;: &quot;8&quot;,
            &quot;code&quot;: &quot;110108&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;TAPAKTUAN&quot;
        },
        {
            &quot;id&quot;: &quot;9&quot;,
            &quot;code&quot;: &quot;110109&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;TRUMON&quot;
        },
        {
            &quot;id&quot;: &quot;10&quot;,
            &quot;code&quot;: &quot;110110&quot;,
            &quot;city_code&quot;: null,
            &quot;name&quot;: &quot;PASIE RAJA&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:1234/api/districts?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:1234/api/districts?page=729&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:1234/api/districts?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 729,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=10&quot;,
                &quot;label&quot;: &quot;10&quot;,
                &quot;page&quot;: 10,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;...&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=728&quot;,
                &quot;label&quot;: &quot;728&quot;,
                &quot;page&quot;: 728,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=729&quot;,
                &quot;label&quot;: &quot;729&quot;,
                &quot;page&quot;: 729,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/districts?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:1234/api/districts&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 7285
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-districts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-districts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-districts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-districts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-districts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-districts" data-method="GET"
      data-path="api/districts"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-districts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-districts"
                    onclick="tryItOut('GETapi-districts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-districts"
                    onclick="cancelTryOut('GETapi-districts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-districts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/districts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-districts"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-districts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-districts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-districts--cityCode-">GET api/districts/{cityCode}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-districts--cityCode-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/districts/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/districts/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-districts--cityCode-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-districts--cityCode-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-districts--cityCode-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-districts--cityCode-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-districts--cityCode-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-districts--cityCode-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-districts--cityCode-" data-method="GET"
      data-path="api/districts/{cityCode}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-districts--cityCode-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-districts--cityCode-"
                    onclick="tryItOut('GETapi-districts--cityCode-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-districts--cityCode-"
                    onclick="cancelTryOut('GETapi-districts--cityCode-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-districts--cityCode-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/districts/{cityCode}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-districts--cityCode-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-districts--cityCode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-districts--cityCode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cityCode</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cityCode"                data-endpoint="GETapi-districts--cityCode-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-villages">GET api/villages</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-villages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/villages" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/villages"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-villages">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;1&quot;,
            &quot;code&quot;: &quot;1101012001&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;KEUDE BAKONGAN&quot;
        },
        {
            &quot;id&quot;: &quot;2&quot;,
            &quot;code&quot;: &quot;1101012002&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;UJONG MANGKI&quot;
        },
        {
            &quot;id&quot;: &quot;3&quot;,
            &quot;code&quot;: &quot;1101012003&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;UJONG PADANG&quot;
        },
        {
            &quot;id&quot;: &quot;4&quot;,
            &quot;code&quot;: &quot;1101012004&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;GAMPONG DRIEN&quot;
        },
        {
            &quot;id&quot;: &quot;5&quot;,
            &quot;code&quot;: &quot;1101012015&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;DARUL IKHSAN&quot;
        },
        {
            &quot;id&quot;: &quot;6&quot;,
            &quot;code&quot;: &quot;1101012016&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;PADANG BEURAHAN&quot;
        },
        {
            &quot;id&quot;: &quot;7&quot;,
            &quot;code&quot;: &quot;1101012017&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;GAMPONG BARO&quot;
        },
        {
            &quot;id&quot;: &quot;8&quot;,
            &quot;code&quot;: &quot;1101022001&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;FAJAR HARAPAN&quot;
        },
        {
            &quot;id&quot;: &quot;9&quot;,
            &quot;code&quot;: &quot;1101022002&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;KRUENG BATEE&quot;
        },
        {
            &quot;id&quot;: &quot;10&quot;,
            &quot;code&quot;: &quot;1101022003&quot;,
            &quot;district_code&quot;: null,
            &quot;name&quot;: &quot;PASI KUALA ASAHAN&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:1234/api/villages?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:1234/api/villages?page=8377&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:1234/api/villages?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 8377,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=10&quot;,
                &quot;label&quot;: &quot;10&quot;,
                &quot;page&quot;: 10,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;...&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=8376&quot;,
                &quot;label&quot;: &quot;8376&quot;,
                &quot;page&quot;: 8376,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=8377&quot;,
                &quot;label&quot;: &quot;8377&quot;,
                &quot;page&quot;: 8377,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost:1234/api/villages?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost:1234/api/villages&quot;,
        &quot;per_page&quot;: 10,
        &quot;to&quot;: 10,
        &quot;total&quot;: 83762
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-villages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-villages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-villages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-villages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-villages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-villages" data-method="GET"
      data-path="api/villages"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-villages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-villages"
                    onclick="tryItOut('GETapi-villages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-villages"
                    onclick="cancelTryOut('GETapi-villages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-villages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/villages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-villages"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-villages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-villages"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-villages--districtCode-">GET api/villages/{districtCode}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-villages--districtCode-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:1234/api/villages/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:1234/api/villages/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-villages--districtCode-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-villages--districtCode-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-villages--districtCode-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-villages--districtCode-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-villages--districtCode-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-villages--districtCode-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-villages--districtCode-" data-method="GET"
      data-path="api/villages/{districtCode}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-villages--districtCode-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-villages--districtCode-"
                    onclick="tryItOut('GETapi-villages--districtCode-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-villages--districtCode-"
                    onclick="cancelTryOut('GETapi-villages--districtCode-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-villages--districtCode-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/villages/{districtCode}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-villages--districtCode-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-villages--districtCode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-villages--districtCode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>districtCode</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="districtCode"                data-endpoint="GETapi-villages--districtCode-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
