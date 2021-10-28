/**
 * Mongodb database initialisation script
 *
 *
 */

var conn = new Mongo('localhost:27018');
var adminDb = conn.getDB('admin');
adminDb.auth('root', 'Mbhj#ksf1445Mbfgqg');
var teamADb = conn.getDB('teama');
teamADb.dropDatabase();
try {
    teamADb.dropUser('admin_teama');
} catch (e) {

}

teamADb.createUser({
    user: 'admin_teama',
    pwd: 'jfkbqsgbEGQ#dd54qfdgb',
    roles: [
        {
            role: "readWrite",
            db: "teama"
        }
    ],
    passwordDigestor: "server"
})

function newId(collectionName) {
    var result = teamADb.counters.findOneAndUpdate({
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

    var documentId = newId('documents');

    teamADb.documents.insert(
        {
            "Id": documentId,
            "Key": "welcome",
            "Headers": {
                "Content": [],
                "Layout": 0
            },
            "Bodies": {
                "Content": [],
                "Layout": 0
            },
            "Footers": {
                "Content": [],
                "Layout": 0
            },
            "OwnerId": 0,
            "CreationDate":
                "2021-10-28T11:04:08.7334731+02:00",
            "UpdateDate": "2021-10-28T11:04:08.7366605+02:00",
            "Visibility": 2,
            "Tags": []
        });
};

initData();

