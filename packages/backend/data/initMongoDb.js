new Mongo();
const users = db.getUsers();
for(var user in users){
  print(user)
}
