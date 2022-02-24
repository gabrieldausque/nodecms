/**
/**
 * Mongodb database initialisation script
 *
 *
 */

var conn = new Mongo('localhost:27018');
var adminDb = conn.getDB('admin');
adminDb.auth('root', 'Mbhj#ksf1445Mbfgqg');
var teamaDb = conn.getDB('teama');
teamaDb.dropDatabase();
try {
    teamaDb.dropUser('admin_teama');
} catch (e) {

}

teamaDb.createUser({
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
    var result = teamaDb.counters.findOneAndUpdate({
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

    var configTitleId = newId('configurations');
    teamaDb.configurations.insert({
        "Id": configTitleId,
        "Key": "title",
        "Value": "The team-A"
    });

    var documentId = newId('documents');

    teamaDb.documents.insert(
        {
            "Id": documentId,
            "Key": "welcome",
            "Title": "Welcome",
            "Headers": {
                "Content": [
                    {
                        "BlocType": "Title",
                        "Properties": {
                            "Text": "The main title"
                        }
                    }
                ],
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

