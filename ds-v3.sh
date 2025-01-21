#/bin/bash

# curl https://api.deepseek.com/chat/completions \
#     -H "Content-Type: application/json" \
#     -H "Authorization: Bearer sk-5730eecff009481b869382403b750cf8" \
#     -d '{
#         "model": "deepseek-chat",
#         "messages": [
#           {"role": "system", "content": "You are a helpful assistant."},
#           {"role": "user", "content": "Hello!"}
#         ],
#         "stream": false
#       }'

# using the httpie
https POST https://api.deepseek.com/chat/completions \
    model=deepseek-chat \
    messages:='[{"role": "system", "content": "You are a helpful assistant."},{"role": "user", "content": "Hello!"}]' \
    stream:=false \
    Authorization:"Bearer sk-5730eecff009481b869382403b750cf8" \
    Content-Type:"application/json" | jq .choices[0].message.content
