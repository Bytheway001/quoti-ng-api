The migrate script

INSERT into [t2.companies] select * from t1.companies
INSERT into [t1.regions] SELECT * from t1.companies

Import Plan Names
INSERT INTO [t2.plan_names](NAME,id) SELECT *,ROW_NUMBER() over (ORDER BY NAME) AS id FROM [t1.plan_names];

Import plans
INSERT INTO [t2.plans](SELECT id, region_id, NAME, if(plan_type='Normal',0,1) AS joint, enabled, quote_type FROM [t1.plans]);