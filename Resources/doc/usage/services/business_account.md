# Business Account

When using a service for business purpose, you will receive a business account from Google. This one allows you to
bypass Google limitation according to your billing plan. To use it, you need to configure it:

```
# app/config/config.yml

ivory_google_map:
    business_account:
        # Your client identifier (not prefixed by `gme-`)
        client_id: "client_id"

        # Your secret
        secret: "secret"

        # Your channel (optional)
        channel: "channel"
```

Providing a `client_id` & a `secret` will automatically enable the business account behavior on all enabled services.
If you  want to learn more, you can read this
[documentation](http://github.com/egeloen/ivory-google-map/blob/master/doc/usage/services/business_account.md).
