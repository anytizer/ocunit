uri = URI('https://hookb.in/xxxxxxxxxxxxxx')

req = Net::HTTP::Post.new(uri, 'Content-Type' => 'application/json')

req.body = {
    name: 'John'
}.to_json

res = Net::HTTP.start(uri.hostname, uri.port) do |http|
    http.request(req)
end
