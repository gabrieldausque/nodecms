/**
 * Mongodb database initialisation script
 * For Video Game
 *
 */

var conn = new Mongo('localhost:27018');
var adminDb = conn.getDB('admin');
adminDb.auth('root', 'Mbhj#ksf1445Mbfgqg');
var videogame = conn.getDB('videogame');
videogame.dropDatabase();
try {
    videogame.dropUser('admin');
} catch (e) {

}

videogame.createUser({
    user: 'admin',
    pwd: 'mqrpvdqDGDSG#54dgbqdk',
    roles: [
        {
            role: "readWrite",
            db: "videogame"
        }
    ],
    passwordDigestor: "server"
})

function newId(collectionName) {
    var result = videogame.counters.findOneAndUpdate({
            name: collectionName
        },
        {
            $inc: { lastId: 1 }
        },
        {
            upsert: true
        });

    if (result && result.lastId) {
        return result.lastId;
    }
    // Id 0 is reserved for new elements
    return 1;
};

function initData() {

    var documentId = newId('scenes');

}

initData();

