#!/usr/bin/env bash
kubectl delete -f Kubernetes/secrets.yml
kubectl delete -f Kubernetes/configmap.yml
kubectl delete -f Kubernetes/pv_storageclass.yml
kubectl delete -f Kubernetes/database_pv.yml
kubectl delete -f Kubernetes/database_pvc.yml
kubectl delete -f Kubernetes/database_service.yml
kubectl delete -f Kubernetes/database_statefulset.yml
kubectl delete -f Kubernetes/app_deployment.yml
kubectl delete -f Kubernetes/web_app_service.yml